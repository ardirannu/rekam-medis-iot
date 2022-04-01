<?php

use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Auth;
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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard.index'); 
    Route::resource('pasien', 'PasienController');
    Route::resource('dokter', 'DokterController');  
    Route::resource('poliklinik', 'PoliklinikController'); 
    Route::resource('obat', 'ObatController');
    Route::resource('kartu', 'KartuController');
    Route::resource('rekam_medis', 'RekamController'); 
    Route::get('rekam_medis/create/rfid', 'RekamController@create_rfid'); 
    //get rfid untuk tambah data kartu pasien
    Route::get('kartu_pasien/rfid/get_rfid', 'KartuController@get_rfid'); 
    //get rfid untuk edit data kartu pasien
    Route::get('kartu_pasien/{id}/rfid/get_rfid', 'KartuController@get_rfid_edit'); 
    //get rfid untuk tambah data rekam medis
    Route::get('rekam_medis/create/rfid/get_rfid', 'KartuController@get_rfid'); 

    // Route::resource('admin/role', 'role\RoleController');
    // Route::resource('admin/user', 'user\UserController'); 
    // Route::resource('admin/admin', 'admin\Role_UserController');
    
}); 
    Auth::routes();

    

