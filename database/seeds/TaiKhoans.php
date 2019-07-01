<?php

use Illuminate\Database\Seeder;

class TaiKhoans extends Seeder
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
        
        DB::table('TaiKhoans')->insert([
            'tendangnhap' => 'admin',
            'matkhau' => Hash::make('12345678'),
            'tennguoidung' => 'admin',
            'gioitinh' => '1',
            'socmnd' => '0831263712',
            'quequan'=>Str::random(10),
            'sdt' => '069696969696',
            'email'=>$faker->email,
            'quyen' => '0',
        ]);

        DB::table('TaiKhoans')->insert([
            'tendangnhap' => 'tester1',
            'matkhau' => Hash::make('12345678'),
            'tennguoidung' => 'tester1',
            'gioitinh' => '0',
            'socmnd' => '078216332',
            'quequan'=>Str::random(10),
            'email'=>$faker->email,
            'sdt' => '0821398172',
            'quyen' => '1',
        ]);
       

        for ($i = 0; $i < $limit; $i++) {
            DB::table('TaiKhoans')->insert([
                'tendangnhap' =>  $faker->unique()->username,
                'matkhau' => Hash::make(Str::random(8)),
                'tennguoidung' => $faker->name,
                'gioitinh' => rand(0, 2),
                'socmnd' => Str::random(10),
                'quequan'=>Str::random(10),
                'sdt' => rand(),
                'email'=>$faker->email,
                'quyen' => rand(0, 1),
            ]);
        }
    }
}
