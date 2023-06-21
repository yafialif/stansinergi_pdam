<?php

// use Symfony\Component\Routing\Route;
// use Illuminate\Routing\Route;
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

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/api/gatdatapelanggan/{id}', 'Admin\DataMeteranPelangganController@getDataPelanggan');
Route::get('/admin/cetakresi/{id}', 'Admin\DataMeteranPelangganController@cetakresi')->name("cetakresi");
Route::group(['middleware' => 'auth'], function () {
    // Routes that require authentication
    Route::POST('/admin/setoran', 'Admin\SetoranController@index')->name('cekstoran');
    Route::POST('/admin/setoran/setor', 'Admin\SetoranController@kirimstoran')->name('kirimstoran');
    // ... other routes that require authentication
});
Route::group(array('prefix' => 'api', 'middleware' => 'cors'), function () {
    Route::get('gatdatapelanggan/{id}', 'Admin\DataMeteranPelangganController@getDataPelanggan');
    Route::get('tagihansebelumnya/{id}', 'Admin\DataMeteranPelangganController@getinfotagiahnlama');
    Route::get('reporttagihanbydate/{startDate}/{endDate}', 'Admin\DataMeteranPelangganController@ReportTagihanByDate');
});
