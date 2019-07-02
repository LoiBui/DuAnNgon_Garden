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


Route::get('testB', function() {
    return view("test");
});
Route::get('/', function () {
    return view('layout/index');
});

Route::get('dangnhap', function () {
    return view("Pages.TaiKhoan.DangNhap");
});

Route::get('taotaikhoan', function () {
    return view("Pages.TaiKhoan.TaoTaiKhoan");
});

Route::post('dangnhap', "MyControllers\TaiKhoanController@dangnhap")->name("dangnhap");
Route::post('taotaikhoan', "MyControllers\TaiKhoanController@store")->name("taotaikhoan");

Route::group(['prefix' => 'taikhoan'], function () {
    Route::get('/', "MyControllers\TaiKhoanController@index");
    Route::get('destroy/{v}', "MyControllers\TaiKhoanController@destroy");
    Route::post('update', "MyControllers\TaiKhoanController@update")->name('taikhoan.update');
});


//NHÀ BẾP
Route::get('nhabep', "MyControllers\NhaBepController@index");
Route::get('getPhieuOrder', "MyControllers\NhaBepController@getPhieuorder");
Route::get('getChiTietPhieubyIdPhieuOrder/{id}', "MyControllers\NhaBepController@getChiTietPhieubyIdPhieuOrder");
Route::post('thaydoitrangthaichitietphieu', "MyControllers\NhaBepController@thaydoitrangthaichitietphieu");
Route::post('thaydoitrangthaiphieuorder', "MyControllers\NhaBepController@thaydoitrangthaiphieuorder");


/*  Le Tan */
Route::group(['prefix' => 'letan'], function () {
    Route::get('/', "MyControllers\LeTanController@index")->name('letan');
    Route::get('taophieu', "MyControllers\LeTanController@taophieu")->name('letan.taophieu')->where('idban', '[0-9]+');
    Route::post('datban', "MyControllers\LeTanController@datban")->name('letan.datban');
});
/* End  Le Tan */