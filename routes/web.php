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
    Route::post('chuyentranthaiban', "MyControllers\LeTanController@chuyentranthaiban")->name('letan.chuyentranthaiban');
});
/* End  Le Tan */


//Thực đơn
Route::group(['prefix' => 'thucdon'], function () {
    Route::get('/',"MyControllers\ThucDonController@index")->name('thucdon');
    Route::get('search',"MyControllers\ThucDonController@search")->name("thucdon.search");
    Route::any('add','MyControllers\ThucDonController@add')->name('thucdon.add');
    Route::post('update','MyControllers\ThucDonController@update')->name('thucdon.update');
    Route::get('destroy/{id}','MyControllers\ThucDonController@destroy')->name('thucdon.destroy');
});


Route::get('datban', function () {
    return view("Pages.DatBanOnline.index");
});

Route::get('thanhcong', function () {
    return view("Pages.DatBanOnline.thanhcong");
});

Route::post("datban", "Controller@datban")->name("datban");
/*  Nhân Viên Phục Vụ */
Route::group(['prefix' => 'nvphucvu'], function () {
    Route::get('/', "MyControllers\NvPhucVuController@index")->name('nvphucvu');
    Route::get('datmon/{idphieuorder}', "MyControllers\NvPhucVuController@datmon")->name('nvphucvu.datmon')->where('idphieuorder', '[0-9]+');
    // Route::post('datmon', "MyControllers\NvPhucVuController@datmon")->name('nvphucvu.datmon');
});
/* End  Nhân Viên Phục Vụ */
