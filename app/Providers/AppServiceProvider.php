<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\TaiKhoan\TaiKhoanRepoInterFace',
            'App\Repositories\TaiKhoan\TaiKhoanRepo'
        );

        $this->app->bind(
            'App\Repositories\PhieuOrder\PhieuOrderRepoInterface',
            'App\Repositories\PhieuOrder\PhieuOrderRepo'
        );

        $this->app->bind(
            'App\Repositories\Ban\BanRepoInterface',
            'App\Repositories\Ban\BanRepo'
        );
        
        $this->app->bind(
            'App\Repositories\ChiTietPhieu\ChiTietPhieuRepoInterface',
            'App\Repositories\ChiTietPhieu\ChiTietPhieuRepo'
        );

        $this->app->bind(
            'App\Repositories\ThucDon\ThucDonRepoInterface',
            'App\Repositories\ThucDon\ThucDonRepo'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
