<?php

namespace App\Http\Controllers;

use App\Models\Categorypengeluaran;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCategorypengeluaranRequest;
use App\Http\Requests\UpdateCategorypengeluaranRequest;

class CategorypengeluaranController extends Controller
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
    public function store(StoreCategorypengeluaranRequest $request)
    {
        Categorypengeluaran::create([
            'masjid_id' => Auth::user()->jamaah->masjid->id,
            'nama' => $request->categoryname,
        ]);
        return redirect()->route('dashboard.pengeluaran')->with('success', 'kategori pengeluaran berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categorypengeluaran $categorypengeluaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorypengeluaran $categorypengeluaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategorypengeluaranRequest $request, Categorypengeluaran $categorypengeluaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorypengeluaran $categorypengeluaran)
    {
        //
    }
}
