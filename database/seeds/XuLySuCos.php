<?php

use Illuminate\Database\Seeder;

class XuLySuCos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hd = DB::table('hoadons')->get()->pluck('id')->toArray();

        $faker = Faker\Factory::create();

       //echo date("Y-m-d H:i:s",rand(1262055681,1262055681));return;
        
        $limit = 100;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('xulysucos')->insert([
                'idhoadon' =>  $faker->randomElement($hd),
                'mieuta' =>  $faker->text,

            ]);
        }
    }
}
