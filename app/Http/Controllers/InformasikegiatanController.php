<?php

namespace App\Http\Controllers;

use App\Models\Informasikegiatan;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreInformasikegiatanRequest;
use App\Http\Requests\UpdateInformasikegiatanRequest;
use Illuminate\Support\Facades\Storage;

class InformasikegiatanController extends Controller
{
    public function index()
    {
        return view('informasikegiatan', [
            'title' => 'Informasi Kegiatan',
            'bodyId' => ''
        ]);
    }

    public function create()
    {
        return view('formkegiatan', [
            'title' => 'Tambah Kegiatan',
            'bodyId' => ''
        ]);
    }

    public function store(StoreInformasikegiatanRequest $request)
    {
        $request['masjid_id'] = Auth::user()->jamaah->masjid->id;
        if($request->hasFile('image')){
            $format = $request->file('image')->getClientOriginalExtension();
            $request['gambar'] = $request->file('image')->storeAs('kegiatan/gambar', $request->name.'-'.Auth::user()->jamaah->masjid->name.'.'.$format, 'public');
        }
        if($request->hasFile('document')){
            $format = $request->file('document')->getClientOriginalExtension();
            $request['dokumen'] = $request->file('document')->storeAs('kegiatan/dokumen', $request->name.'-'.Auth::user()->jamaah->masjid->name.'.'.$format, 'public'); 
        }
        Informasikegiatan::create($request->all());
        return redirect()->route('dashboard.kegiatan')->with('success', 'Kegiatan mesjid berhasil ditambahkan');;
    }

    public function show(Informasikegiatan $informasikegiatan)
    {
        return view('informasikegiatan', [
            'title' => 'Informasi Kegiatan',
            'bodyId' => '',
            'informasikegiatan' => $informasikegiatan
        ]);
    }

    public function edit(Informasikegiatan $informasikegiatan)
    {
        return view('formkegiatan', [
            'title' => 'Ubah Kegiatan',
            'bodyId' => '',
            'informasikegiatan' => $informasikegiatan
        ]);
    }

    public function update(UpdateInformasikegiatanRequest $request, Informasikegiatan $informasikegiatan)
    {
        if($request->hasFile('image')){
            if($informasikegiatan->gambar != null){
                Storage::delete('public/'.$informasikegiatan->gambar);
            }
            $format = $request->file('image')->getClientOriginalExtension();
            $request['gambar'] = $request->file('image')->storeAs('kegiatan/gambar', $request->name.'-'.Auth::user()->jamaah->masjid->name.'.'.$format, 'public');
        }
        if($request->hasFile('document')){
            if($informasikegiatan->dokumen != null){
                Storage::delete('public/'.$informasikegiatan->dokumen);
            }
            $format = $request->file('document')->getClientOriginalExtension();
            $request['dokumen'] = $request->file('document')->storeAs('kegiatan/dokumen', $request->name.'-'.Auth::user()->jamaah->masjid->name.'.'.$format, 'public'); 
        }
        $informasikegiatan->update($request->all());
        return redirect()->route('dashboard.kegiatan')->with('success', 'kegiatan mesjid berhasil diubah');
    }

    public function destroy(Informasikegiatan $informasikegiatan)
    {
        if($informasikegiatan->gambar != null){
            Storage::delete('public/'.$informasikegiatan->gambar);
        }
        if($informasikegiatan->dokumen != null){
            Storage::delete('public/'.$informasikegiatan->dokumen);
        }
        $informasikegiatan->delete();
        return redirect()->route('dashboard.kegiatan')->with('success', 'kegiatan mesjid berhasil dihapus');
    }
}
