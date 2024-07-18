<?php

namespace App\Http\Controllers;

use App\Models\Jamaah;
use Carbon\Carbon;
use App\Http\Requests\StoreJamaahRequest;
use App\Http\Requests\UpdateJamaahRequest;
use App\Models\Informasikegiatan;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class JamaahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('index', [
            'title' => 'Homepage',
            'dates' => collect(range(Carbon::now()->year - max(0, (Carbon::now()->year - 2015)), Carbon::now()->year))->reverse(),
            'bodyId' => '',
            'rekapitulasi' => $this->getRekapitulasiData(),
            'start' => null,
            'end' => null
        ]);
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

    public function filteryear(Request $request){
        $rekapitulasi = $this->getRekapitulasiData();
        $filteredRekapitulasi = [
            'tanggal' => [],
            'total' => [],
        ];
        foreach ($rekapitulasi['tanggal'] as $key => $date) {
            $current = new DateTime($date);
            if ($current >= new DateTime($request->before) && $current <= new DateTime($request->after)) {
                array_push($filteredRekapitulasi['tanggal'], $date);
                array_push($filteredRekapitulasi['total'], $rekapitulasi['total'][$key]);
            }
        }
        return view('index', [
            'title' => 'Homepage',
            'dates' => collect(range(Carbon::now()->year - max(0, (Carbon::now()->year - 2015)), Carbon::now()->year))->reverse(),
            'bodyId' => '',
            'rekapitulasi' => $filteredRekapitulasi,
            'start' => $request->before,
            'end' => $request->after
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJamaahRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Jamaah $jamaah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jamaah $jamaah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJamaahRequest $request, Jamaah $jamaah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jamaah $jamaah)
    {
        //
    }
}
