<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TaiKhoans::class);
        // $this->call(Bans::class);
        // $this->call(ThucDons::class);
        // $this->call(PhieuOrders::class);
        // $this->call(ChiTietPhieus::class);
        // $this->call(HoaDons::class);     
        // $this->call(XuLySuCos::class);
    }
}
