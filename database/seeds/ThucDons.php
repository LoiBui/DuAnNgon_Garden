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
        $faker = Faker\Factory::create();

        $limit = 100;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('ThucDons')->insert([
                'ten'=>$faker->name,
                'giatien'=>rand(10000, 500000),
                'loai'=>rand(0, 2),
                'anh'=>Str::random(30),
                'ghichu'=>$faker->text,
            ]);
        }
    }
}
