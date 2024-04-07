<?php

use Illuminate\Support\Facades\Route;

Route::controller(\App\Http\Controllers\AuthController::class)->name('auth.')->group(function(){
    Route::middleware(['guest'])->group(function () {
        Route::get('/login', 'index')->name('login');
        Route::get('/register/jamaah', 'createjamaah')->name('register-jamaah');
        Route::get('/register/admin', 'createadmin')->name('register-admin');
        Route::get('/register', 'create')->name('register');
        Route::post('/register/jamaah', 'store')->name('store-jamaah');
        Route::post('/register/admin', 'storeadmin')->name('store-admin');
        Route::post('/login', 'authorized')->name('authorize');
    });
    Route::get('/logout', 'logout')->name('logout')->middleware('auth');
});

Route::resource('masjid', \App\Http\Controllers\MasjidController::class)->middleware('guest');

Route::controller(\App\Http\Controllers\DashboardController::class)->name('dashboard.')->group(function(){
    Route::middleware(['auth','isAdmin'])->group(function () {
        Route::get('/dashboard', 'index')->name('index');
        Route::middleware('isRoleBendahara')->group(function(){
            Route::get('/dashboard/pemasukan', 'pemasukan')->name('pemasukan');
            Route::get('/dashboard/pengeluaran', 'pengeluaran')->name('pengeluaran');
        });
        Route::middleware('isRolePengurusDKM')->group(function(){
            Route::get('/dashboard/laporankeuangan', 'laporankeuangan')->name('laporan');
            Route::post('/dashboard/laporankeuangan', 'laporankeuangan')->name('laporan');            
            Route::get('/dashboard/asset', 'assetmesjid')->name('asset_mesjid');
            Route::get('/dashboard/kegiatan', 'kegiatan')->name('kegiatan');
        });
        Route::get('/dashboard/kelolaadmin', 'kelola')->name('kelola')->middleware('isRoleAdmin');
    });
});

Route::controller(\App\Http\Controllers\DashboardmasterController::class)->name('master.')->middleware(['auth', 'isMaster'])->group(function (){
    Route::get('/master', 'index')->name('index');
});
Route::put('usermaster/{user}', [\App\Http\Controllers\UserController::class, 'update'])->middleware(['auth','isMaster'])->name('user-master.update');
Route::delete('usermaster/{user}', [\App\Http\Controllers\UserController::class, 'destroy'])->middleware(['auth','isMaster'])->name('user-master.destroy');

Route::resource('user', \App\Http\Controllers\UserController::class)->middleware(['auth','isAdmin','isRoleAdmin']);
Route::resource('pemasukan', \App\Http\Controllers\PemasukanController::class)->middleware('auth');
Route::resource('pengeluaran', \App\Http\Controllers\PengeluaranController::class)->middleware('auth');

Route::resource('jamaah', \App\Http\Controllers\JamaahController::class)->middleware('auth');
Route::post('jamaah', [\App\Http\Controllers\JamaahController::class, 'filteryear'])->name('jamaah.filteryear')->middleware('auth');

Route::middleware('isAdmin')->resource('informasikegiatan', \App\Http\Controllers\InformasikegiatanController::class)->except(['index', 'show']);
Route::middleware('auth')->resource('informasikegiatan', \App\Http\Controllers\InformasikegiatanController::class)->except(['show']);
Route::resource('informasikegiatan', \App\Http\Controllers\InformasikegiatanController::class);

Route::resource('aset', \App\Http\Controllers\AsetController::class)->middleware('auth');
Route::resource('laporankeuangan', \App\Http\Controllers\LaporankeuanganController::class)->middleware('auth');
Route::post('laporankeuangan', [\App\Http\Controllers\LaporankeuanganController::class, 'index'])->middleware('auth')->name('laporankeuangan.index');

Route::get('/', function () {
    return redirect()->route('masjid.index');
})->middleware('guest');
