<?php

use Illuminate\Database\Seeder;

class DatBans extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

       //echo date("Y-m-d H:i:s",rand(1262055681,1262055681));return;
        
        $limit = 10;

        for ($i = 1; $i <= $limit; $i++) {
            DB::table('datbans')->insert([
                'idban' =>  $i,
              	'ngaydat'=> date("Y-m-d",rand(1262055681,1262055681)),
                'giodat'=>rand(0, 24),
                'tenkhachhang'=>$faker->name,
                'sdt'=>rand(),
                'trangthai'=>0,
            ]);
        }
    }
}
