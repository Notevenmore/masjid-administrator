<?php

namespace App\Http\Controllers;

use App\Models\Laporankeuangan;
use App\Http\Requests\StoreLaporankeuanganRequest;
use App\Http\Requests\UpdateLaporankeuanganRequest;
use Illuminate\Http\Request;

class LaporankeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
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
    public function store(StoreLaporankeuanganRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Laporankeuangan $laporankeuangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Laporankeuangan $laporankeuangan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLaporankeuanganRequest $request, Laporankeuangan $laporankeuangan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Laporankeuangan $laporankeuangan)
    {
        //
    }
}
