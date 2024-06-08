<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\BansosController;
use App\Http\Controllers\PenerimaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

//route index testing tampilan
Route::get('/', [WelcomeController::class, 'index']);

//route login
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'proses_login'])->name('proses_login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

//route autentikasi berdasarkan levelnya
Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['cek_login:1']], function () {
        Route::get('/admin/index', [UserController::class, 'index'])->name('admin.index');
    });
    Route::group(['middleware' => ['cek_login:2']], function () {
        Route::get('/rt/index', [UserController::class, 'index'])->name('rt.index');
    });
    Route::group(['middleware' => ['cek_login:3']], function () {
        Route::get('/user/index', [UserController::class, 'index'])->name('user.index');
    });
});

//route warga
Route::group(['prefix' => 'warga'], function() {
    Route::get('/', [WargaController::class, 'index']);          
    Route::post('/list', [WargaController::class, 'list']);      
    Route::get('/create', [WargaController::class, 'create']);   
    Route::post('/', [WargaController::class, 'store']);         
    Route::get('/{id}', [WargaController::class, 'show']);
    Route::get('/{id}/edit', [WargaController::class, 'edit']);  
    Route::put('/{id}', [WargaController::class, 'update']);     
    Route::get('/{id}/ubah_status', [WargaController::class, 'ubahStatus']);
    Route::put('/{id}/update_status', [WargaController::class, 'updateStatus']);
});

// Route untuk Riwayat Warga
Route::group(['prefix' => 'riwayat'], function() {
    Route::get('/', [RiwayatController::class, 'index']);          
    Route::post('/list', [RiwayatController::class, 'list']);
    Route::get('/{id}', [RiwayatController::class, 'show']);
});

//route bansos
Route::group(['prefix' => 'bansos'], function() {
    Route::get('/', [BansosController::class, 'index']);          
    Route::post('/list', [BansosController::class, 'list']);      
    Route::get('/create', [BansosController::class, 'create']);   
    Route::post('/', [BansosController::class, 'store']);         
    Route::get('/{id}', [BansosController::class, 'show']);       
    Route::get('/{id}/edit', [BansosController::class, 'edit']);  
    Route::put('/{id}', [BansosController::class, 'update']);     
    Route::delete('/{id}', [BansosController::class, 'destroy']); 
});

//router profil
Route::group(['prefix' => 'profil'], function() {
    Route::get('/', [ProfilController::class, 'show']);
    Route::get('/{id}/edit', [ProfilController::class, 'edit']); 
    Route::put('/{id}', [ProfilController::class, 'update']);
});

//router setting
Route::group(['prefix' => 'setting'], function() {
    Route::get('/', [SettingController::class, 'index']);
});

// Route untuk Pengajuan Dokumen
Route::group(['prefix' => 'pengajuan-dokumen'], function() {
    Route::get('/', [BansosController::class, 'index']);          
    Route::post('/list', [BansosController::class, 'list']);      
    Route::get('/create', [BansosController::class, 'create']);   
    Route::post('/', [BansosController::class, 'store']);
});

// Route untuk Pengajuan Bansos
Route::group(['prefix' => 'pengajuan-bansos'], function() {
    Route::get('/', [PenerimaController::class, 'index']);          
    Route::post('/list', [PenerimaController::class, 'list']);      
    Route::get('/create/{id}', [PenerimaController::class, 'create']);   
    Route::post('/', [PenerimaController::class, 'store']);
});

// Route untuk Pengajuan Dokumen
Route::group(['prefix' => 'penerima'], function() {
    Route::get('/', [PenerimaController::class, 'show']);          
    Route::post('/showup', [PenerimaController::class, 'showup']);
    Route::get('/accept/{id}', [PenerimaController::class, 'accept']);
    Route::get('/reject/{id}', [PenerimaController::class, 'reject']);  
    
    Route::get('/create', [PenerimaController::class, 'create']);   
    Route::post('/', [PenerimaController::class, 'store']);         
    Route::get('/{id}', [PenerimaController::class, 'show']);       
    Route::get('/{id}/edit', [PenerimaController::class, 'edit']);  
    Route::put('/{id}', [PenerimaController::class, 'update']);     
    Route::delete('/{id}', [PenerimaController::class, 'destroy']); 
});