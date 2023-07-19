<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ShopsServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shopsServices = [
            [
                'shop_id' => 1, // ID của shop liên kết
                'service_id' => 1, // ID của service liên kết
                'service_price' => 40000,
                'service_image' => 'cattoc.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'shop_id' => 1, // ID của shop liên kết
                'service_id' => 2, // ID của service liên kết
                'service_price' => 20000,
                'service_image' => 'caomat.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'shop_id' => 1, // ID của shop liên kết
                'service_id' => 3, // ID của service liên kết
                'service_price' => 20000,
                'service_image' => 'caorau.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'shop_id' => 1, // ID của shop liên kết
                'service_id' => 4, // ID của service liên kết
                'service_price' => 15000,
                'service_image' => 'ngoaytai.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'shop_id' => 1, // ID của shop liên kết
                'service_id' => 5, // ID của service liên kết
                'service_price' => 25000,
                'service_image' => 'goidau.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'shop_id' => 1, // ID của shop liên kết
                'service_id' => 6, // ID của service liên kết
                'service_price' => 150000,
                'service_image' => 'nhuomtoc.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'shop_id' => 1, // ID của shop liên kết
                'service_id' => 7, // ID của service liên kết
                'service_price' => 20000,
                'service_image' => 'dapmatna.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'shop_id' => 1, // ID của shop liên kết
                'service_id' => 8, // ID của service liên kết
                'service_price' => 40000,
                'service_image' => 'matxa.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'shop_id' => 1, // ID của shop liên kết
                'service_id' => 9, // ID của service liên kết
                'service_price' => 30000,
                'service_image' => 'lotmun.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // shop 2
            [
                'shop_id' => 2, // ID của shop liên kết
                'service_id' => 1, // ID của service liên kết
                'service_price' => 50000,
                'service_image' => 'cattoc.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'shop_id' => 2, // ID của shop liên kết
                'service_id' => 2, // ID của service liên kết
                'service_price' => 25000,
                'service_image' => 'caomat.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'shop_id' => 2, // ID của shop liên kết
                'service_id' => 3, // ID của service liên kết
                'service_price' => 25000,
                'service_image' => 'caorau.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'shop_id' => 2, // ID của shop liên kết
                'service_id' => 4, // ID của service liên kết
                'service_price' => 15000,
                'service_image' => 'ngoaytai.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'shop_id' => 2, // ID của shop liên kết
                'service_id' => 5, // ID của service liên kết
                'service_price' => 25000,
                'service_image' => 'goidau.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'shop_id' => 2, // ID của shop liên kết
                'service_id' => 6, // ID của service liên kết
                'service_price' => 150000,
                'service_image' => 'nhuomtoc.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'shop_id' => 2, // ID của shop liên kết
                'service_id' => 7, // ID của service liên kết
                'service_price' => 20000,
                'service_image' => 'dapmatna.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'shop_id' => 2, // ID của shop liên kết
                'service_id' => 8, // ID của service liên kết
                'service_price' => 40000,
                'service_image' => 'matxa.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'shop_id' => 2, // ID của shop liên kết
                'service_id' => 9, // ID của service liên kết
                'service_price' => 30000,
                'service_image' => 'lotmun.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // shop 3
            [
                'shop_id' => 3, // ID của shop liên kết
                'service_id' => 1, // ID của service liên kết
                'service_price' => 40000,
                'service_image' => 'cattoc.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'shop_id' => 3, // ID của shop liên kết
                'service_id' => 2, // ID của service liên kết
                'service_price' => 30000,
                'service_image' => 'caomat.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'shop_id' => 3, // ID của shop liên kết
                'service_id' => 3, // ID của service liên kết
                'service_price' => 30000,
                'service_image' => 'caorau.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'shop_id' => 3, // ID của shop liên kết
                'service_id' => 4, // ID của service liên kết
                'service_price' => 15000,
                'service_image' => 'ngoaytai.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'shop_id' => 3, // ID của shop liên kết
                'service_id' => 5, // ID của service liên kết
                'service_price' => 25000,
                'service_image' => 'goidau.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'shop_id' => 3, // ID của shop liên kết
                'service_id' => 6, // ID của service liên kết
                'service_price' => 150000,
                'service_image' => 'nhuomtoc.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'shop_id' => 3, // ID của shop liên kết
                'service_id' => 7, // ID của service liên kết
                'service_price' => 20000,
                'service_image' => 'dapmatna.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'shop_id' => 3, // ID của shop liên kết
                'service_id' => 8, // ID của service liên kết
                'service_price' => 40000,
                'service_image' => 'matxa.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'shop_id' => 3, // ID của shop liên kết
                'service_id' => 9, // ID của service liên kết
                'service_price' => 30000,
                'service_image' => 'lotmun.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('shops_services')->insert($shopsServices);
    }
}
