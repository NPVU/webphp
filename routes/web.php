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
Route::get('/quan-ly/san-pham/', 'SanPhamController@getDanhSachSanPham');
Route::get('helloword', 'HelloWordController@getHelloWordTitle');
Route::group(['prefix' => 'services'], function(){
	Route::get('ticket/{file}/{loginkey}/{apikey}', 'ServicesController@openloadTicketAPI');
	Route::get('download/{file}/{loginkey}/{apikey}', 'ServicesController@openloadDownloadAPI');	
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
