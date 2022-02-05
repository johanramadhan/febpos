<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home1');


Route::prefix('admin')
    ->namespace('Admin')
    ->group(function() {
        Route::get('/', 'DashboardController@index')->name('dashboard-admin');

        Route::resource('category', 'CategoryController');
        Route::resource('supplier', 'SupplierController');
        Route::resource('member', 'MemberController');
        Route::resource('product', 'ProductController');

        // Pembelian
        Route::resource('transaction/pembelian', 'PembelianController');
        Route::get('/pembelian/{id}/tambah', 'PembelianController@tambah')->name('tambah-pembelian');

        // Pembelian-Detail
        Route::get('data-transaction/pembelian_detail/{id}/data', 'PembelianDetailController@data')->name('pembelian_detail.data');
        Route::get('data-transaction/pembelian_detail/loadform/{diskon}/{total}', 'PembelianDetailController@loadForm')->name('pembelian_detail.load_form');
        Route::resource('transaction/pembelian_detail', 'PembelianDetailController');
        
    });
