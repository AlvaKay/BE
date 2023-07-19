<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class StylistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stylists = [
            // shop 2
            [
                'stylist_name' => 'Anh Quân',
                'stylist_image' => 'anhquan.jpg',
                'shop_id' => 1, // ID của shop liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'stylist_name' => 'Khoa Nguyễn',
                'stylist_image' => 'khoanguyen.jpg',
                'shop_id' => 1, // ID của shop liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // shop 3
            [
                'stylist_name' => 'Độ Phùng',
                'stylist_image' => 'dophung.jpg',
                'shop_id' => 2, // ID của shop liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'stylist_name' => 'Tiến Đạt',
                'stylist_image' => 'tiendat.jpg',
                'shop_id' => 2, // ID của shop liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'stylist_name' => 'Đại Tô',
                'stylist_image' => 'daito.jpg',
                'shop_id' => 2, // ID của shop liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'stylist_name' => 'Sơn Hồ',
                'stylist_image' => 'sonho.jpg',
                'shop_id' => 2, // ID của shop liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            //shop 4
            [
                'stylist_name' => 'Thanh Quang',
                'stylist_image' => 'thanhquang.jpg',
                'shop_id' => 3, // ID của shop liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'stylist_name' => 'Xuân Lê',
                'stylist_image' => 'xuanle.jpg',
                'shop_id' => 3, // ID của shop liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'stylist_name' => 'Tân Thanh',
                'stylist_image' => 'Tân Thanh.jpg',
                'shop_id' => 3, // ID của shop liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'stylist_name' => 'Duy Nguyễn',
                'stylist_image' => 'duynghuyen.jpg',
                'shop_id' => 3, // ID của shop liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'stylist_name' => 'Thương Nguyễn',
                'stylist_image' => 'thuongnguyen.jpg',
                'shop_id' => 3, // ID của shop liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'stylist_name' => 'Thành Đồng',
                'stylist_image' => 'thanhdong.jpg',
                'shop_id' => 3, // ID của shop liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Thêm thông tin của các stylist khác tại đây
        ];

        DB::table('stylists')->insert($stylists);
    }
}
