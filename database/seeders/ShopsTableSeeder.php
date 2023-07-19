<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class ShopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shops = [
            [
                'shop_name' => 'Công Seven',
                'shop_image' => 'Congseven.jpg',
                'shop_phone' => '123456789',
                'user_id' => 2, // ID của user liên kết
                'is_shop' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'shop_name' => 'Luxury Man',
                'shop_image' => 'luxuryman.jpg',
                'shop_phone' => '987654321',
                'user_id' => 3, // ID của user liên kết
                'is_shop' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'shop_name' => 'Thơ barber shop',
                'shop_image' => 'thobarbershop.jpg',
                'shop_phone' => '987654321',
                'user_id' => 4, // ID của user liên kết
                'is_shop' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
            // Thêm thông tin của các shop khác tại đây
        ];

        DB::table('shops')->insert($shops);
    }
}
