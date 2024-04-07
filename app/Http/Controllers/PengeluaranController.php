<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Support\Facades\Auth;
use App\Models\Laporankeuangan;
use App\Http\Requests\StorePengeluaranRequest;
use App\Http\Requests\UpdatePengeluaranRequest;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StorePengeluaranRequest $request)
    {
        $request['masjid_id'] = Auth::user()->jamaah->masjid->id;
        $pengeluaran = Pengeluaran::create($request->all());
        Laporankeuangan::create([
            'admin_id' => Auth::user()->admin->id,
            'pengeluaran_id' => $pengeluaran->id,
            'masjid_id' => Auth::user()->jamaah->masjid->id
        ]);
        return redirect()->route('dashboard.pengeluaran')->with('success', 'dana pengeluaran berhasil terdata');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengeluaran $pengeluaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengeluaran $pengeluaran)
    {
        return view('updatetransaction', [
            'title' => 'Ubah Pengeluaran',
            'bodyId' => '',
            'transaction' => $pengeluaran,
            'action' => route('pengeluaran.update', ['pengeluaran' => $pengeluaran])
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePengeluaranRequest $request, Pengeluaran $pengeluaran)
    {
        $pengeluaran->update($request->all());
        return redirect()->route('dashboard.pengeluaran')->with('success', 'dana pengeluaran berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengeluaran $pengeluaran)
    {
        $pengeluaran->delete();
        return redirect()->route('dashboard.pengeluaran')->with('success', 'dana pengeluaran berhasil dihapus');
    }
}
