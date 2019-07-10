<?php

use Illuminate\Database\Seeder;

class ChiTietPhieus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $phieu = DB::table('PhieuOrders')->get()->pluck('id')->toArray();

    	$thucdon = DB::table('ThucDons')->get()->pluck('id')->toArray();

        $faker = Faker\Factory::create();

       //echo date("Y-m-d H:i:s",rand(1262055681,1262055681));return;
        
        $limit = 10;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('ChiTietPhieus')->insert([
                'idphieuorder' =>  $faker->randomElement($phieu),
                'idmon' =>  $faker->randomElement($thucdon),
                'soluong'=>rand(1, 10),
                'ghichu'=>$faker->text,
                'trangthai'=>rand(0, 2)

            ]);
        }
    }
}
