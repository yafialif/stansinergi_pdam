<?php

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

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/api/gatdatapelanggan/{id}', 'Admin\DataMeteranPelangganController@getDataPelanggan');
Route::get('/admin/cetakresi/{id}', 'Admin\DataMeteranPelangganController@cetakresi')->name("cetakresi");

Route::group(array('prefix' => 'api', 'middleware' => 'cors'), function () {
    Route::get('gatdatapelanggan/{id}', 'Admin\DataMeteranPelangganController@getDataPelanggan');
    Route::get('tagihansebelumnya/{id}', 'Admin\DataMeteranPelangganController@getinfotagiahnlama');
});
