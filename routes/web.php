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
Route::get('nhabep', "MyControllers\NhaBepController@index");
Route::post('dangnhap', "MyControllers\TaiKhoanController@dangnhap")->name("dangnhap");
Route::post('taotaikhoan', "MyControllers\TaiKhoanController@store")->name("taotaikhoan");

Route::group(['prefix' => 'taikhoan'], function () {
    Route::get('/', "MyControllers\TaiKhoanController@index");
    Route::get('destroy/{v}', "MyControllers\TaiKhoanController@destroy");
    Route::post('update', "MyControllers\TaiKhoanController@update")->name('taikhoan.update');
});
