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

        // $limit = 100;
        
        DB::table('TaiKhoans')->insert([
            'username' => 'admin',
            'password' => Hash::make('12345678'),
            'tennguoidung' => 'Nguyễn Đức Trung',
            'gioitinh' => '1',
            'socmnd' => '017353314',
            'quequan'=>'Hà Đông Hà Nội',
            'sdt' => '0348598316',
            'email'=>'nguyenductrung112233@gmail.com',
            'quyen' => '0',
        ]);

        DB::table('TaiKhoans')->insert([
            'username' => 'nhabep',
            'password' => Hash::make('12345678'),
            'tennguoidung' => 'Phan Văn Hinh',
            'gioitinh' => '1',
            'socmnd' => '078216332',
            'quequan'=>'Việt Nam',
            'email'=>'Phanvanhinh@mail.com',
            'sdt' => '0988888888',
            'quyen' => '1',
        ]);

        DB::table('TaiKhoans')->insert([
            'username' => 'phucvu',
            'password' => Hash::make('12345678'),
            'tennguoidung' => 'Nguyễn Văn An',
            'gioitinh' => '1',
            'socmnd' => '0123456789',
            'quequan'=>'Việt Nam',
            'email'=>'Nguyenvanan@mail.com',
            'sdt' => '0899999999',
            'quyen' => '2',
        ]);

        DB::table('TaiKhoans')->insert([
            'username' => 'letan',
            'password' => Hash::make('12345678'),
            'tennguoidung' => 'Bùi Công Lợi',
            'gioitinh' => '1',
            'socmnd' => '0168686868',
            'quequan'=>'Việt Nam',
            'email'=>'htsbuicongloi@mail.com',
            'sdt' => '0968686868',
            'quyen' => '3',
        ]);
       

        // for ($i = 0; $i < $limit; $i++) {
        //     DB::table('TaiKhoans')->insert([
        //         'username' =>  $faker->unique()->username,
        //         'password' => Hash::make(Str::random(8)),
        //         'tennguoidung' => $faker->name,
        //         'gioitinh' => rand(0, 2),
        //         'socmnd' => Str::random(10),
        //         'quequan'=>Str::random(10),
        //         'sdt' => rand(),
        //         'email'=>$faker->email,
        //         'quyen' => rand(0, 1),
        //     ]);
        // }
    }
}
