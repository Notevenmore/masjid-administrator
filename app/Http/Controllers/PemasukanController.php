<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Exports\PemasukanExport;
use App\Models\Laporankeuangan;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePemasukanRequest;
use App\Http\Requests\UpdatePemasukanRequest;

class PemasukanController extends Controller
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
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePemasukanRequest $request)
    {
        $request['masjid_id'] = Auth::user()->jamaah->masjid->id;
        $pemasukan = Pemasukan::create($request->all());
        Laporankeuangan::create([
            'admin_id' => Auth::user()->admin->id,
            'pemasukan_id' => $pemasukan->id,
            'masjid_id' => Auth::user()->jamaah->masjid->id
        ]);
        return redirect()->route('dashboard.pemasukan')->with('success', 'dana pemasukan berhasil terdata');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemasukan $pemasukan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemasukan $pemasukan)
    {
        return view('updatetransaction', [
            'title' => 'Ubah Pemasukan',
            'bodyId' => '',
            'transaction' => $pemasukan,
            'action' => route('pemasukan.update', ['pemasukan' => $pemasukan])
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePemasukanRequest $request, Pemasukan $pemasukan)
    {
        $pemasukan->update($request->all());
        return redirect()->route('dashboard.pemasukan')->with('success', 'dana pemasukan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemasukan $pemasukan)
    {
        $pemasukan->delete();
        return redirect()->route('dashboard.pemasukan')->with('success', 'dana pemasukan berhasil dihapus');
    }
}
