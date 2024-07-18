<?php
namespace App\Http\Controllers;
use App\Models\Kas;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Laporankeuangan;
use App\Models\Pemasukan;
use \Midtrans\Config;
use \Midtrans\Snap;


class DashboardController extends Controller
{
    public function index(){
        return view('Dashboard', [
            'title' => 'Dashboard',
            'bodyId' => '',
            'date' => Carbon::now(),
            'rekapitulasi' => $this->getRekapitulasiData(),
            'pemasukan' => $this->getPemasukanData(),
            'pengeluaran' => $this->getPengeluaranData(),
            'jamaahPaideds' => $this->getKasPaidedData(),
            'banyakJamaah' => Auth::user()->jamaah->masjid->jamaah->count()
        ]);
    }
    private function getKasPaidedData() {
        $tanggalArray = Auth::user()->jamaah->masjid->kas->pluck('created_at')->toArray();
        $unique = array_unique(array_map(function($date) {
            return Carbon::parse($date)->format('Y-m');
        }, $tanggalArray));
        $data = array_map(function($date) {
            $paid = 0;
            foreach(Auth::user()->jamaah->masjid->kas as $kas) {
                if($kas->status == "Paid" && Carbon::parse($kas->created_at)->format('Y-m') == Carbon::parse($date)->format('Y-m')) {
                    $paid++;
                }
            }
            return [
                "tanggal" => $date,
                "userpaided" => $paid
            ];
        }, $unique);
        usort($data, function($a, $b) {
            return strtotime($a['tanggal']) <=> strtotime($b['tanggal']);
        });
        return $data;
    }
    private function getRekapitulasiData() {
        $rekapitulasi = ["tanggal" => [], "total" => []];
        $tanggalsebelum = null;
        $total = 0;
        // data tabel rekapitulasi
        foreach(Auth::user()->jamaah->masjid->laporankeuangan()->table()->get() as $rekap){
            if($rekap->pemasukan != null){
                $total += $rekap->pemasukan->jumlah;
                if($rekap->pemasukan->tanggal != $tanggalsebelum){
                    array_push($rekapitulasi["total"], $total);                    
                    array_push($rekapitulasi["tanggal"], $rekap->pemasukan->tanggal);                    
                }
                $tanggalsebelum = $rekap->pemasukan->tanggal;
            }elseif($rekap->pengeluaran != null){
                $total -= $rekap->pengeluaran->jumlah;
                if($rekap->pengeluaran->tanggal != $tanggalsebelum){
                    array_push($rekapitulasi["total"], $total);                    
                    array_push($rekapitulasi["tanggal"], $rekap->pengeluaran->tanggal);                    
                }
                $tanggalsebelum = $rekap->pengeluaran->tanggal;
            }
        }

        return $rekapitulasi;
    }

    private function getPengeluaranData() {
        $unique_pengeluaran = [];
        $uangkasadded = false;
        $pengeluaran = Auth::user()->jamaah->masjid->pengeluaran;
        foreach(Auth::user()->jamaah->masjid->pengeluaran()->select('keterangan')->distinct()->get() as $unique) {
            array_push($unique_pengeluaran, [
               "category" => $unique->keterangan,
               "nominal" => $pengeluaran->where('keterangan', 'like', $unique->keterangan)->sum('jumlah')
            ]);
        }

        return $unique_pengeluaran;
    }

    private function getPemasukanData() {
        $unique_pemasukan = [];
        $uangkasadded = false;
        $pemasukan = Auth::user()->jamaah->masjid->pemasukan;
        foreach(Auth::user()->jamaah->masjid->pemasukan()->select('sumber_dana')->distinct()->get() as $unique) {
            if(strpos($unique->sumber_dana, "Uang Kas") !== false) {
                if(!$uangkasadded) {
                    array_push($unique_pemasukan, [
                        "category" => "Uang Kas", 
                        "nominal" => $pemasukan->where('sumber_dana', 'like', $unique->sumber_dana)->sum('jumlah'),
                    ]);
                    $uangkasadded = true;
                } else {
                    $key = array_search("Uang Kas", array_column($unique_pemasukan, 'category'));
                    $unique_pemasukan[$key]['nominal'] += $pemasukan->where('sumber_dana', 'like', $unique->sumber_dana)->sum('jumlah');
                }
            } else {
                array_push($unique_pemasukan, [
                   "category" => $unique->sumber_dana,
                   "nominal" => $pemasukan->where('sumber_dana', 'like', $unique->sumber_dana)->sum('jumlah')
                ]);
            }
        }

        return $unique_pemasukan;
    }

    public function cashPayment(Request $request) {
        $location = Auth::user()->jamaah->masjid;
        $request->request->add([
            'name'=> Auth::user()->name, 
            'phone' => Auth::user()->telp, 
            'address' => $location->location.', '.$location->subdistrict.', '.$location->cityorregency.', '.$location->province,
            'status' => 'Unpaid',
            'user_id' => Auth::user()->id,
            'masjid_id' => $location->id,
        ]);
        $kas = Kas::create($request->all());
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => 'kasmasjidadmin'.$kas->id,
                'gross_amount' => $kas->nominal,
            ),
            'customer_details' => array(
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => Auth::user()->telp,
            ),
        );

        $snapToken = Snap::getSnapToken($params);
        return response()->json(['snapToken' => $snapToken]);
    }

    public function callback(Request $request) {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        if($hashed == $request->signature_key) {
            if($request->transaction_status == "capture" or $request->transaction_status == "settlement") {
                preg_match('/\d+/', $request->order_id, $matches);
                $kas_id = $matches[0];
                $kas = Kas::find($kas_id);
                $kas->update(['status' => 'Paid']);
                $pemasukan = Pemasukan::create([
                    'tanggal' => Carbon::now()->format('Y-m-d'),
                    'jumlah' => $kas->nominal,
                    'masjid_id' => $kas->masjid_id,
                    'sumber_dana' => 'Uang Kas '.$kas->user->name,
                ]);
                Laporankeuangan::create([
                    'admin_id' => $kas->user_id,
                    'pemasukan_id'=> $pemasukan->id,
                    'masjid_id' => $kas->masjid_id
                ]);
            }
        }
    }

    public function afterPayment() {
        return view('thanks', [
            'title' => 'Thanks',
            'bodyId' => '',
        ]);
    }

    public function pemasukan(){
        return view('transaksi', [
            'title' => 'Pemasukan',
            'bodyId' => '',
            'action_store' => route('pemasukan.store'),
            'kategori_store' => route('categorypemasukan.store'),
        ]);
    }

    public function pengeluaran(){
        return view('transaksi', [
            'title' => 'Pengeluaran',
            'bodyId' => '',
            'action_store' => route('pengeluaran.store'),
            'kategori_store' => route('categorypengeluaran.store'),
        ]);
    }

    public function laporankeuangan(Request $request){
        return view('laporan', [
            'title' => 'Laporan Keuangan',
            'bodyId' => '',
            'no' => 1,
            'saldo' => 0,
            'masuk' => 0,
            'keluar' => 0,
            'start' => $request->start,
            'end' => $request->end
        ]);
    }

    public function assetmesjid(){
        return view('asset', [
            'title' => 'Aset Masjid',
            'bodyId' => '',
        ]);
    }

    public function kegiatan(){
        return view('kegiatan', [
            'title' => 'Informasi Kegiatan',
            'bodyId' => '',
        ]);
    }

    public function kelola(){
        return view('kelola', [
            'title' => 'Kelola Jamaah',
            'bodyId' => '',
        ]);
    }
}
