<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Grafikpemasukan;
use App\Models\Grafikpengeluaran;
use App\Models\Laporankeuangan;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Informasikegiatan;

class DashboardController extends Controller
{
    public function index(){
        $rekapitulasi = ["tanggal" => [], "total" => []];
        $tanggalsebelum = null;
        $total = 0;
        foreach(Auth::user()->jamaah->masjid->laporankeuangan()->table()->get() as $rekap){
            if($rekap->pemasukan != null){
                if($rekap->pemasukan->tanggal != $tanggalsebelum){
                    array_push($rekapitulasi["total"], $total);                    
                    array_push($rekapitulasi["tanggal"], $rekap->pemasukan->tanggal);                    
                }
                $total += $rekap->pemasukan->jumlah;
                $tanggalsebelum = $rekap->pemasukan->tanggal;
            }elseif($rekap->pengeluaran != null){
                if($rekap->pengeluaran->tanggal != $tanggalsebelum){
                    array_push($rekapitulasi["total"], $total);                    
                    array_push($rekapitulasi["tanggal"], $rekap->pengeluaran->tanggal);                    
                }
                $total -= $rekap->pengeluaran->jumlah;
                $tanggalsebelum = $rekap->pengeluaran->tanggal;
            }
        }

        return view('Dashboard', [
            'title' => 'Dashboard',
            'bodyId' => '',
            'date' => Carbon::now(),
            'rekapitulasi' => $rekapitulasi,
        ]);
    }

    public function pemasukan(){
        return view('transaksi', [
            'title' => 'Pemasukan',
            'bodyId' => '',
            'action_store' => route('pemasukan.store')
        ]);
    }

    public function pengeluaran(){
        return view('transaksi', [
            'title' => 'Pengeluaran',
            'bodyId' => '',
            'action_store' => route('pengeluaran.store')
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
