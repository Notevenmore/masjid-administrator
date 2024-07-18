<?php

namespace App\Http\Controllers;

use App\Models\Categorypemasukan;
use App\Http\Requests\StoreCategorypemasukanRequest;
use App\Http\Requests\UpdateCategorypemasukanRequest;
use Illuminate\Support\Facades\Auth;

class CategorypemasukanController extends Controller
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
    public function store(StoreCategorypemasukanRequest $request)
    {
        Categorypemasukan::create([
            'masjid_id' => Auth::user()->jamaah->masjid->id,
            'nama' => $request->categoryname,
        ]);
        return redirect()->route('dashboard.pemasukan')->with('success', 'kategori pemasukan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categorypemasukan $categorypemasukan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorypemasukan $categorypemasukan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategorypemasukanRequest $request, Categorypemasukan $categorypemasukan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorypemasukan $categorypemasukan)
    {
        //
    }
}
