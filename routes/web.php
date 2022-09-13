<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['auth']], function () {
    Route::get('/admin', 'HomeController@index')->name('admin.index');
    Route::get('/home', 'HomeController@index')->name('admin.index');

    Route::get('/panen', 'PanenController@index')->name('panen.index');
    Route::get('/panen/create', 'PanenController@create')->name('panen.create');
    Route::post('/panen/create', 'PanenController@store')->name('panen.store');
    Route::get('/panen/edit/{id}', 'PanenController@edit')->name('panen.edit');
    Route::patch('/panen/edit/{id}', 'PanenController@update')->name('panen.update');
    Route::get('/panen/jual', 'PanenController@createPembelian')->name('panen.cjual');
    Route::post('/panen/jual', 'PanenController@storePembelian')->name('panen.sjual');
    Route::get('/panen/{id}', 'PanenController@detailPanen')->name('panen.detail');
    Route::get('/hargaBeli', 'PanenController@hargaBeli')->name('panen.harga');
    
    Route::get('/penjualanHarian', 'PenjualanController@indexHarian')->name('penjualan.indexHarian');
    Route::get('/penjualanKeseluruhan', 'PenjualanController@indexKeseluruhan')->name('penjualan.indexKeseluruhan');
    Route::get('/penjualan/create', 'PenjualanController@create')->name('penjualan.create');
    Route::post('/penjualan/create', 'PenjualanController@store')->name('penjualan.store');
    Route::get('/penjualan/createHarga', 'PenjualanController@createHarga')->name('penjualan.createHarga');
    Route::post('/penjualan/storeHarga', 'PenjualanController@storeHarga')->name('penjualan.storeHarga');
    Route::get('/penjualan/editHarga/{id}', 'PenjualanController@editHarga')->name('penjualan.editHarga');
    Route::patch('/penjualan/editHarga/{id}', 'PenjualanController@updateHarga')->name('penjualan.updateHarga');
    Route::get('/penjualan/{id}', 'PenjualanController@detailPenjualan')->name('penjualan.detail');
    Route::get('/hargaJual', 'PenjualanController@hargaJual')->name('penjualan.harga');
    Route::get('/penjualan/editStatus/{id}', 'PenjualanController@editStatus')->name('penjualan.editStatus');
    Route::post('/penjualan/updateStatus/{id}', 'PenjualanController@updateStatus')->name('penjualan.updateStatus');
    
    Route::get('/pengeluaranHarian', 'PengeluaranController@indexHarian')->name('pengeluaran.indexHarian');
    Route::get('/pengeluaranKeseluruhan', 'PengeluaranController@indexKeseluruhan')->name('pengeluaran.indexKeseluruhan');
    Route::get('/pengeluaran/create', 'PengeluaranController@create')->name('pengeluaran.create');
    Route::post('/pengeluaran/create', 'PengeluaranController@store')->name('pengeluaran.store');
    Route::get('/pengeluaran/createNew', 'PengeluaranController@createNew')->name('pengeluaran.createNew');
    Route::get('/pengeluaran/edit/{id}', 'PengeluaranController@edit')->name('pengeluaran.edit');
    Route::patch('/pengeluaran/edit/{id}', 'PengeluaranController@update')->name('pengeluaran.update');

    Route::resource('petani', PetaniController::class);
    Route::resource('pembeli', PembeliController::class);
});

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
