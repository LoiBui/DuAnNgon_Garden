<?php

use Illuminate\Database\Seeder;

class Bans extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('bans')->insert([
        //     'sochongoi' => 2,
        //     'loaiban' => 1,
        //     'mota' => 'Khu A',
        //     'phuphi' => '0',
        //     'ghichu' => 'Khách đặt bàn lúc 5h chiều ngày 23/2/2019',
        //     'trangthai' => '2',
        // ]);

        // DB::table('bans')->insert([
        //     'sochongoi' => 2,
        //     'loaiban' => 0,
        //     'mota' => 'Khu B',
        //     'phuphi' => '100000',
        //     'ghichu' => '',
        //     'trangthai' => '0',
        // ]);

        // DB::table('bans')->insert([
            // 'sochongoi' => 4,
            // 'loaiban' => 1,
            // 'mota' => 'Khu C',
            // 'phuphi' => '0',
            // 'ghichu' => '',
            // 'trangthai' => '1',
        // ]);
        $limit = 100;
        $array = array("Khu A", "Khu B", "Khu C");

        for ($i = 0; $i < $limit; $i++) {
            $loaiban = rand(0, 1);
            DB::table('bans')->insert([
                    'sochongoi' => rand(1, 20),
                    'loaiban' => $loaiban,
                    'mota' => $array[rand(0, 2)],
                    'phuphi' => $loaiban==0?0:rand(100000, 500000),
                    'ghichu' => 'khong',
                    'trangthai' => 0,
            ]);
        }
    }
}
