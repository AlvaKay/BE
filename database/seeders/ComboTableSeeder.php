<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class ComboTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $combos = [
            [
                'combo_name' => 'Truyền thống',
                'combo_description' => 'Description for Combo 1',
                'combo_price' => 60000,
                'shop_id' => 1, // ID của shop liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'combo_name' => 'Đế Vương',
                'combo_description' => 'Description for Combo 2',
                'combo_price' => 70000,
                'shop_id' => 1, // ID của shop liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // shop 2
            [
                'combo_name' => 'Truyền thống',
                'combo_description' => 'Description for Combo 1',
                'combo_price' => 70000,
                'shop_id' => 2, // ID của shop liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'combo_name' => 'Đế Vương',
                'combo_description' => 'Description for Combo 2',
                'combo_price' => 90000,
                'shop_id' => 2, // ID của shop liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // shop 3
            [
                'combo_name' => 'Truyển thống',
                'combo_description' => 'Description for Combo 1',
                'combo_price' => 50000,
                'shop_id' => 3, // ID của shop liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'combo_name' => 'Đế Vương',
                'combo_description' => 'Description for Combo 2',
                'combo_price' => 100000,
                'shop_id' => 3, // ID của shop liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ];

        DB::table('combo')->insert($combos);
    }
}
