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

Route::get('/quan-ly/', 'QuanLyController@index');

Route::get('/quan-ly/danh-muc/san-pham/', 'SanPhamController@getDanhSachSanPham');

Route::group(['prefix'=>'/quan-ly/nhan-cong/nhan-vien'],function(){
    Route::get('/','NhanVienController@index');
    Route::get('/add','NhanVienController@add');
    Route::get('/edit','NhanVienController@edit');
    Route::get('/delete','NhanVienController@delete');
});

Route::group(['prefix'=>'/quan-ly/chi-tieu'],function(){
    Route::get('/','ChiTieuController@index');
    Route::get('/add','ChiTieuController@add');
    Route::get('/edit','ChiTieuController@edit');
    Route::get('/delete','ChiTieuController@delete');
});

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
