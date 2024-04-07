<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Master;
use App\Models\Jamaah;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;

class UserController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if(isset($request->role)){
            if($request->role == 'jamaah'){
                Admin::where('id', $user->admin_id)->update(['status' => false, 'role' => null]);
            }else{
                Admin::where('id', $user->admin_id)->update(['status' => true, 'role' => $request->role]);
            }
            return redirect()->route('dashboard.kelola')->with('success', 'Data Jamaah atau Pengurus telah berhasil diupdate');
        }else{
            if(isset($request->admin)){
                Admin::where('id', $user->admin_id)->update(['status' => true, 'role' => $request->admin]);
            }else{
                Admin::where('id', $user->admin_id)->update(['status' => false, 'role' => null]);
            }
            if(isset($request->master)){
                Master::where('id', $user->master_id)->update(['status' => true]);
            }else{
                Master::where('id', $user->master_id)->update(['status' => false]);
            }
            return redirect()->route('master.index')->with('success', 'Data user berhasil diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        Admin::where('id', $user->id)->delete();
        Master::where('id', $user->id)->delete();
        Jamaah::where('id', $user->id)->delete();
        $user->delete();
        if(URL::previous() == route('master.index')){
            return redirect()->route('master.index')->with('success', 'Data user telah berhasil dihapus');
        }
        return redirect()->route('dashboard.kelola')->with('success', 'Data Jamaah atau Pengurus telah berhasil dihapus');
    }
}
