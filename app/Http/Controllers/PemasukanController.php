<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Exports\PemasukanExport;
use App\Models\Laporankeuangan;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePemasukanRequest;
use App\Http\Requests\UpdatePemasukanRequest;
use App\Models\User;
use App\Models\Kas;

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
        if($request->sumber_dana == "Uang Kas") {
            $user = Auth::user();
            if($request->uangKas != "hanya untuk sumber dana Uang Kas (Jika bukan, silahkan dikosongkan)") {
                $user = User::where('id', $request->uangKas)->first();
            } 
            $request['sumber_dana'] = $request->sumber_dana." $user->name";
            $kas = Kas::create([
                'name'=> $user->name, 
                'phone' => $user->telp, 
                'address' => '',
                'status' => 'Paid',
                'user_id' => $user->id,
                'masjid_id' => $user->jamaah->masjid->id,
                'nominal' => $request->jumlah,
            ]);
            $kas->created_at = $request->tanggal;
            $kas->save();
        }
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
