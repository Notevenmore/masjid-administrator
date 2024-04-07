<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Http\Requests\StoreAsetRequest;
use App\Http\Requests\UpdateAsetRequest;
use Illuminate\Support\Facades\Auth;

class AsetController extends Controller
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
    public function store(StoreAsetRequest $request)
    {
        $request['masjid_id'] = Auth::user()->jamaah->masjid->id;
        Aset::create($request->all());
        return redirect()->route('dashboard.asset_mesjid')->with('success', 'aset mesjid berhasil didata');
    }

    /**
     * Display the specified resource.
     */
    public function show(Aset $aset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aset $aset)
    {
        return view('updateasset', [
            'title' => 'Ubah Aset',
            'bodyId' => '',
            'aset' => $aset
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAsetRequest $request, Aset $aset)
    {
        $aset->update($request->all());
        return redirect()->route('dashboard.asset_mesjid')->with('success', 'data aset mesjid berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aset $aset)
    {
        $aset->delete();
        return redirect()->route('dashboard.asset_mesjid')->with('success', 'aset mesjid berhasil dihapus');
    }
}
