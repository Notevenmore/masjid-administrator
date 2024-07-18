<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jamaah;
use App\Models\Master;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use App\Models\Masjid;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index(){
        return view('auth', [
            'title' => 'LOGIN',
            'bodyId' => 'bg-login',
            'ready' => 'Belum',
            'linknext' => 'auth.register',
            'go_action' => 'register',
            'action' => 'auth.authorize'
        ]);
    }

    public function create(){
        return view('auth', [
            'title' => 'REGISTER',
            'bodyId' => 'bg-login',
        ]);
    }

    public function createAdmin(){
        return view('auth', [
            'title' => 'REGISTER',
            'bodyId' => 'bg-login',
            'ready' => 'Sudah',
            'linknext' => 'auth.login',
            'go_action' => 'login',
            'action' => 'auth.store-admin',
        ]);
    }

    public function createJamaah(){
        return view('auth', [
            'title' => 'REGISTER',
            'bodyId' => 'bg-login',
            'ready' => 'Sudah',
            'linknext' => 'auth.login',
            'go_action' => 'login',
            'action' => 'auth.store-jamaah',
            'masjids' => Masjid::all()
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:10',
            'masjid' => 'required',
            'telp' => 'required',
        ]);
        $admin = Admin::create([
            'status' => false
        ]);
        $jamaah = Jamaah::create([
            'status' => true,
            'masjid_id'=>$request->masjid
        ]);
        $master = Master::create([
            'status' => false
        ]);
        $user = User::create([
            'admin_id' => $admin->id,
            'jamaah_id' => $jamaah->id,
            'master_id' => $master->id,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'name' => $request->name,
            'telp' => $request->telp,
        ]);
        return redirect()->route('auth.login')->with('success', 'Registrasi berhasil dilakukan! Akun anda telah terdaftar sebagai jamaah');
    }

    public function storeadmin(Request $request){
        $request->validate([
            'adminname' => 'required|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:10',
            'mosquename' => 'required',
            'location' => 'required',
            'subdistrict' => 'required',
            'city' => 'required',
            'province' => 'required'
        ]);
        $masjid = Masjid::filter($request->all());
        if($masjid->exists()){
            return redirect()->route('auth.register-jamaah')->with('success', 'Masjid yang anda daftarkan telah tersedia, Daftar sebagai jamaah terlebih dahulu, kemudian minta admin terkait untuk menjadikan anda sebagai admin pada masjid yang dimaksud');
        }else{
            $masjid = Masjid::create([
                'name' => $request->mosquename,
                'location' => $request->location,
                'subdistrict' => $request->subdistrict,
                'cityorregency' => $request->city,
                'province' => $request->province
            ]);
        }
        $admin = Admin::create([
            'status' => true,
            'role' => 'admin'
        ]);
        $master = Master::create([
            'status' => false
        ]);
        $jamaah = Jamaah::create([
            'status' => true,
            'masjid_id'=>$masjid->id
        ]);
        User::create([
            'admin_id' => $admin->id,
            'jamaah_id' => $jamaah->id,
            'master_id' => $master->id,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'name' => $request->adminname,
            'telp' => $request->telp,
        ]);
        return redirect()->route('auth.login')->with('success', 'Registrasi berhasil dilakukan! Akun anda telah terdaftar sebagai admin');
    }

    public function authorized(Request $request){
        $credentials = $request->validate([
            'email' => 'email|required',
            'password' => 'required|min:10'
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            if(Auth::user()->master->status){
                return redirect()->route('master.index');
            }else if(Auth::user()->admin->status){
                return redirect()->route('dashboard.index');
            }else{
                return redirect()->route('jamaah.index');
            }
        }else{
            return redirect()->route('auth.login')->with('failed', 'Email belum terdaftar atau password yang dimasukkan salah! Coba lagi atau lakukan registrasi sekarang!');
        }
    }

    public function logout(){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('auth.login')->with('success', 'Anda telah berhasil keluar dari akun!');
    }
}
