<?php

use Illuminate\Database\Seeder;

class ThucDons extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $limit = 100;
        $food = "Mon an ";
        for ($i = 0; $i < $limit; $i++) {
            DB::table('thucdons')->insert([
                'ten'=> $food . $i,
                'giatien'=>rand(10000, 500000),
                'loai'=>rand(0, 2),
                'anh'=>Str::random(30),
                'ghichu'=> 'Khong'
            ]);
        }
    }
}
