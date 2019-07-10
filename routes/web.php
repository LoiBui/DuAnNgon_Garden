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

Route::group(['middleware'=>'admin.guest'], function() {
    Route::get('dangnhap', function () {
        return view("Pages.TaiKhoan.DangNhap");
    });
    Route::post('dangnhap', "MyControllers\TaiKhoanController@dangnhap")->name("dangnhap");
});

Route::group(['middleware'=>'admin.auth'], function() {
    // Route::get('dashboard', function () {
    //     return view("Pages.TaiKhoan.Dashboard");
    // })->name('dashboard');
    Route::get('/dashboard', "MyControllers\TaiKhoanController@dashboard")->name('dashboard');

    Route::group(['middleware'=>'admin.admin'], function() {
        Route::get('taotaikhoan', function () {
            return view("Pages.TaiKhoan.TaoTaiKhoan");
        });
        Route::post('taotaikhoan', "MyControllers\TaiKhoanController@store")->name("taotaikhoan");
        Route::group(['prefix' => 'taikhoan'], function () {
            Route::get('/', "MyControllers\TaiKhoanController@index");
            Route::get('/sua', "MyControllers\TaiKhoanController@showsua");
            Route::get('destroy/{v}', "MyControllers\TaiKhoanController@destroy");
            Route::post('update', "MyControllers\TaiKhoanController@update")->name('taikhoan.update');
        });
        /*  Bàn Ăn */
        Route::group(['prefix' => 'ban'], function () {
            Route::get('/', "MyControllers\BanController@index")->name('ban');
            Route::get('them', "MyControllers\BanController@showthem")->name('ban.them');
            Route::post('them', "MyControllers\BanController@them")->name('ban.them');
            Route::get('sua/{idban}', "MyControllers\BanController@showsua")->name('ban.sua')->where('idban', '[0-9]+');
            Route::post('sua/{idban}', "MyControllers\BanController@sua")->name('ban.sua')->where('idban', '[0-9]+');
            Route::delete('xoa/{idban}', "MyControllers\BanController@sua")->name('ban.sua')->where('idban', '[0-9]+');
        });

        Route::group(['prefix' => 'phanhoi'], function () {
            Route::get('danhsach', "Controller@danhsach")->name('admin.phanhoi.danhsach');
            Route::get('xoa/{id}', "Controller@xoa")->name('admin.phanhoi.xoa');
        });
        /* End  Bàn Ăn */
    });

    //Thực đơn
    Route::group(['prefix' => 'thucdon'], function () {
        Route::get('/',"MyControllers\ThucDonController@index")->name('thucdon');
        Route::post('search',"MyControllers\ThucDonController@search")->name("thucdon.search");
        Route::any('add','MyControllers\ThucDonController@add')->name('thucdon.add');
        Route::post('update','MyControllers\ThucDonController@update')->name('thucdon.update');
        Route::get('destroy/{id}','MyControllers\ThucDonController@destroy')->name('thucdon.destroy');
    });
    /* End  Thực đơn */
    
    Route::group(['middleware'=>'admin.nhabep'], function() {
        //NHÀ BẾP
        Route::get('nhabep', "MyControllers\NhaBepController@index")->name('nhabep');
        Route::get('getPhieuOrder', "MyControllers\NhaBepController@getPhieuorder");
        Route::get('getChiTietPhieubyIdPhieuOrder/{id}', "MyControllers\NhaBepController@getChiTietPhieubyIdPhieuOrder");
        Route::post('thaydoitrangthaichitietphieu', "MyControllers\NhaBepController@thaydoitrangthaichitietphieu");
        Route::post('thaydoitrangthaiphieuorder', "MyControllers\NhaBepController@thaydoitrangthaiphieuorder");
    });

    Route::group(['middleware'=>'admin.letan'], function() {
        /*  Le Tan */
        Route::group(['prefix' => 'letan'], function () {
            Route::get('/', "MyControllers\LeTanController@index")->name('letan');
            Route::get('taophieu', "MyControllers\LeTanController@taophieu")->name('letan.taophieu')->where('idban', '[0-9]+');
            Route::post('datban', "MyControllers\LeTanController@datban")->name('letan.datban');
            Route::post('chuyentranthaiban', "MyControllers\LeTanController@chuyentranthaiban")->name('letan.chuyentranthaiban');
            Route::post('chuyentranthaibanonline', "MyControllers\LeTanController@chuyentranthaibanonline")->name('letan.chuyentranthaibanonline');
            Route::get('getidphieuorderByidBan/{id}', "MyControllers\LeTanController@getidphieuorderByidBan")->name('letan.getidphieuorderByidBan');
            Route::get('getidphieuorderByidBan/{type}/{id}', "MyControllers\LeTanController@getidphieuorderByidBan")->name('letan.getidphieuorderByidBan');
            Route::post('chuyentrangthaidatban', "MyControllers\LeTanController@chuyentrangthaidatban")->name('letan.chuyentrangthaidatban');
        });
        /* End  Le Tan */

        /* Đặt Bàn Online */
        Route::get('datban', function () {
            return view("Pages.DatBanOnline.index");
        });
        Route::get('thanhcong', function () {
            return view("Pages.DatBanOnline.thanhcong");
        })->name("thanhcong");
        Route::post("datban", "Controller@datban")->name("datban");
        /* End  Đặt Bàn Online */
    });

    Route::group(['middleware'=>'admin.phucvu'], function() {
        /*  Nhân Viên Phục Vụ */
        Route::group(['prefix' => 'nvphucvu'], function () {
            Route::get('/', "MyControllers\NvPhucVuController@index")->name('nvphucvu');
            Route::get('phieuorder/{idphieuorder}/datmon', "MyControllers\NvPhucVuController@datmon")->name('nvphucvu.datmon')->where('idphieuorder', '[0-9]+');
            Route::post('phieuorder/{idphieuorder}/datmon/{idmon}', "MyControllers\NvPhucVuController@themmon")->name('nvphucvu.themmon')->where('idphieuorder', '[0-9]+');
            Route::post('phieuorder/{idphieuorder}/suamon/{idchitietphieuorder}', "MyControllers\NvPhucVuController@suamon")->name('nvphucvu.suamon')->where('idphieuorder', '[0-9]+');
            Route::get('/ajax/getchitietphieu', "MyControllers\NvPhucVuController@ajax")->name('ajax');
            Route::get('phieuorder/{idphieuorder}/xoamon/{idchitietphieuorder}', "MyControllers\NvPhucVuController@xoamon")->name('nvphucvu.xoamon');
        });
        /* End  Nhân Viên Phục Vụ */
    });
    Route::get('dangxuat','MyControllers\TaiKhoanController@dangxuat')->name('admin.dangxuat');
});

//feedback
Route::get('phanhoi',"Controller@phanhoi");
Route::post('phanhoi',"Controller@checkhd")->name('phanhoi.checkhd');
Route::post('phanhoisave',"Controller@savephanhoi")->name('phanhoi.phanhoisave');