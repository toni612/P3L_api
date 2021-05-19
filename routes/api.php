<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// GET CURRENT USER DETAILS
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'Api\KaryawanController@login');

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('role', 'Api\RoleController@index');
    Route::get('IDRole/{nama}', 'Api\RoleController@getIDbyNama');
    Route::post('role', 'Api\RoleController@store');
    Route::put('role/{id}', 'Api\RoleController@update');

    Route::get('karyawan', 'Api\KaryawanController@index');
    Route::post('karyawan', 'Api\KaryawanController@store');
    Route::put('karyawan/{id}', 'Api\KaryawanController@update');
    Route::put('resignKaryawan/{id}', 'Api\KaryawanController@resign');

    Route::get('meja', 'Api\MejaController@index');
    Route::get('IDMeja/{nomor}', 'Api\MejaController@getIDbyNomor');
    Route::post('meja', 'Api\MejaController@store');
    Route::put('meja/{id}', 'Api\MejaController@update');
    Route::delete('meja/{id}', 'Api\MejaController@destroy');

    Route::get('customer', 'Api\CustomerController@index');
    Route::get('IDCustomer/{nama}', 'Api\CustomerController@getIDbyNama');
    Route::post('customer', 'Api\CustomerController@store');
    Route::put('customer/{id}', 'Api\CustomerController@update');
    Route::delete('customer/{id}', 'Api\CustomerController@destroy');

    Route::get('stokBahan', 'Api\StokBahanController@index');
    Route::get('IDStokBahan/{nama}', 'Api\StokBahanController@getIDbyNama');
    Route::post('stokBahan', 'Api\StokBahanController@store');
    Route::put('stokBahan/{id}', 'Api\StokBahanController@update');
    Route::delete('stokBahan/{id}', 'Api\StokBahanController@destroy');

    Route::get('reservasi', 'Api\ReservasiController@index');
    Route::post('reservasi', 'Api\ReservasiController@store');
    Route::put('reservasi/{id}', 'Api\ReservasiController@update');
    Route::delete('reservasi/{id}', 'Api\ReservasiController@destroy');
    
    Route::get('detailStokAll', 'Api\DetailStokController@index');
    Route::get('detailStok/{id}', 'Api\DetailStokController@showByID');
    Route::post('detailStok', 'Api\DetailStokController@store');
    Route::put('detailStok/{id}', 'Api\DetailStokController@update');
    Route::delete('detailStok/{id}', 'Api\DetailStokController@destroy');
    
    Route::post('menu', 'Api\MenuController@store');
    Route::put('menu/{id}', 'Api\MenuController@update');
    Route::delete('menu/{id}', 'Api\MenuController@destroy');

    Route::get('pesanan', 'Api\PesananController@index');
    Route::post('pesanan', 'Api\PesananController@store');
    Route::put('pesanan/{id}', 'Api\PesananController@update');
    Route::delete('pesanan/{id}', 'Api\PesananController@destroy');
    Route::put('statusPesanan/{id}', 'Api\PesananController@statusDisajikan');

    Route::get('detailPesanan', 'Api\DetailPesananController@index');
    Route::post('detailPesanan', 'Api\DetailPesananController@store');
    Route::put('detailPesanan/{id}', 'Api\DetailPesananController@update');
    Route::delete('detailPesanan/{id}', 'Api\DetailPesananController@destroy');

    Route::get('transaksi', 'Api\TransaksiController@index');
    Route::post('transaksi', 'Api\TransaksiController@store');
    Route::put('transaksi/{id}', 'Api\TransaksiController@update');
    Route::delete('transaksi/{id}', 'Api\TransaksiController@destroy');
});

Route::get('menu', 'Api\MenuController@index');
Route::get('reservasiRelation/{id}', 'Api\ReservasiController@getReservasiRelation');