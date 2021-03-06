<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PhieuOrders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$bans = DB::table('bans')->get()->pluck('id')->toArray();

    	$tks = DB::table('taikhoans')->get()->pluck('id')->toArray();

        $faker = Faker\Factory::create();

       //echo date("Y-m-d H:i:s",rand(1262055681,1262055681));return;
        
        $limit = 100;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('phieuoders')->insert([
                'idban' =>  $faker->randomElement($bans),
                'idnhanvien' =>  $faker->randomElement($tks),

            ]);
        }
    }
}
