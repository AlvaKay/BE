<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $addresses = [
            [
                'shop_id' => 1, // ID của shop liên kết
                'address' => '97 phạm cự lượng',
                'longitude' => 16.05690816700685,
                'latitude' => 108.23739677587157,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'shop_id' => 2, // ID của shop liên kết
                'address' => '101B lê Hữu Trác',
                'longitude' => 16.059091833253788, 
                'latitude' => 108.2412657045002,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'shop_id' => 3, // ID của shop liên kết
                'address' => '62 Châu Thị Vĩnh Tế',
                'longitude' => 16.052155243226803,
                'latitude' => 108.23995391377743,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Thêm thông tin của các địa chỉ khác tại đây
        ];

        DB::table('addresses')->insert($addresses);
    }
}
