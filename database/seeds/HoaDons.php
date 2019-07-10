<?php

use Illuminate\Database\Seeder;

class HoaDons extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $PhieuOrders = DB::table('PhieuOrders')->get()->pluck('id')->toArray();

        $faker = Faker\Factory::create();

       //echo date("Y-m-d H:i:s",rand(1262055681,1262055681));return;
        
        $limit = 10;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('HoaDons')->insert([
                'idphieu' =>  $faker->randomElement($PhieuOrders),
              	'tongtien'=> '0',
              	'trangthai'=>rand(0, 1)

            ]);
        }
    }
}
