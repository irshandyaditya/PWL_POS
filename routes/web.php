<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/kategori', [KategoriController::class, 'index']);

Route::get('/',  [WelcomeController::class, 'index']);
Route::group(['prefix' => 'user'], function(){
    Route::get('/', [UserController::class, 'index']);          //menampilkan halaman awal
    Route::post('/list', [UserController::class, 'list']);      //menampilkan data user
    Route::get('/create', [UserController::class, 'create']);  //menampilkan halaman form tambah user
    Route::post('/',  [UserController::class, 'store']);        //menyimpan data user baru
    Route::get('/{id}', [UserController::class, 'show']);       //menampilkan detail user
    Route::get('/{id}/edit', [UserController::class, 'edit']);  //menampilkan halaman form edit user
    Route::put('/{id}', [UserController::class, 'update']);     //menyimpan perubahan data user
    Route::delete('/{id}', [UserController::class, 'destroy']); //menghapus data user
});

Route::group(['prefix' => 'level'], function(){
    Route::get('/', [LevelController::class, 'index']);          //menampilkan halaman awal
    Route::post('/list', [LevelController::class, 'list']);      //menampilkan data user
    Route::get('/create', [LevelController::class, 'create']);  //menampilkan halaman form tambah user
    Route::post('/',  [LevelController::class, 'store']);        //menyimpan data user baru
    Route::get('/{id}', [LevelController::class, 'show']);       //menampilkan detail user
    Route::get('/{id}/edit', [LevelController::class, 'edit']);  //menampilkan halaman form edit user
    Route::put('/{id}', [LevelController::class, 'update']);     //menyimpan perubahan data user
    Route::delete('/{id}', [LevelController::class, 'destroy']); //menghapus data user
});

Route::group(['prefix' => 'kategori'], function(){
    Route::get('/', [KategoriController::class, 'index']);          //menampilkan halaman awal
    Route::post('/list', [KategoriController::class, 'list']);      //menampilkan data user
    Route::get('/create', [KategoriController::class, 'create']);  //menampilkan halaman form tambah user
    Route::post('/',  [KategoriController::class, 'store']);        //menyimpan data user baru
    Route::get('/{id}', [KategoriController::class, 'show']);       //menampilkan detail user
    Route::get('/{id}/edit', [KategoriController::class, 'edit']);  //menampilkan halaman form edit user
    Route::put('/{id}', [KategoriController::class, 'update']);     //menyimpan perubahan data user
    Route::delete('/{id}', [KategoriController::class, 'destroy']); //menghapus data user
});

Route::group(['prefix' => 'barang'], function(){
    Route::get('/', [BarangController::class, 'index']);          //menampilkan halaman awal
    Route::post('/list', [BarangController::class, 'list']);      //menampilkan data user
    Route::get('/create', [BarangController::class, 'create']);  //menampilkan halaman form tambah user
    Route::post('/',  [BarangController::class, 'store']);        //menyimpan data user baru
    Route::get('/{id}', [BarangController::class, 'show']);       //menampilkan detail user
    Route::get('/{id}/edit', [BarangController::class, 'edit']);  //menampilkan halaman form edit user
    Route::put('/{id}', [BarangController::class, 'update']);     //menyimpan perubahan data user
    Route::delete('/{id}', [BarangController::class, 'destroy']); //menghapus data user
});

Route::group(['prefix' => 'stok'], function(){
    Route::get('/', [StokController::class, 'index']);          //menampilkan halaman awal
    Route::post('/list', [StokController::class, 'list']);      //menampilkan data user
    Route::get('/create', [StokController::class, 'create']);  //menampilkan halaman form tambah user
    Route::post('/',  [StokController::class, 'store']);        //menyimpan data user baru
    Route::get('/{id}', [StokController::class, 'show']);       //menampilkan detail user
    Route::get('/{id}/edit', [StokController::class, 'edit']);  //menampilkan halaman form edit user
    Route::put('/{id}', [StokController::class, 'update']);     //menyimpan perubahan data user
    Route::delete('/{id}', [StokController::class, 'destroy']); //menghapus data user
});

Route::group(['prefix' => 'penjualan'], function(){
    Route::get('/', [PenjualanController::class, 'index']);          //menampilkan halaman awal
    Route::post('/list', [PenjualanController::class, 'list']);      //menampilkan data user
    Route::get('/create', [PenjualanController::class, 'create']);  //menampilkan halaman form tambah user
    Route::post('/',  [PenjualanController::class, 'store']);        //menyimpan data user baru
    Route::get('/{id}', [PenjualanController::class, 'show']);       //menampilkan detail user
    Route::get('/{id}/edit', [PenjualanController::class, 'edit']);  //menampilkan halaman form edit user
    Route::put('/{id}/{idDetail}', [PenjualanController::class, 'update']);     //menyimpan perubahan data user
    Route::delete('/{id}', [PenjualanController::class, 'destroy']); //menghapus data user
    Route::get('/get-harga/{id}', [PenjualanController::class, 'getHarga']); //get harga
});

// Route::get('/level', [LevelController::class, 'index']);
// Route::get('/level/tambah', [LevelController::class, 'tambah']);
// Route::post('/kategori', [KategoriController::class, 'store']);
// Route::get('/kategori/create', [KategoriController::class, 'create']);
// Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
// Route::put('/kategori/edit_simpan/{id}', [KategoriController::class, 'edit_simpan']);
// Route::get('/kategori/hapus/{id}', [KategoriController::class, 'hapus'])->name('kategori.hapus');

Route::resource('m_user', POSController::class);