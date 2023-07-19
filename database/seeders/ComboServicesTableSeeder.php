<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class ComboServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comboServices = [
            [
                'combo_id' => 1, // ID của combo liên kết
                'service_id' => 1, // ID của service liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'combo_id' => 1, // ID của combo liên kết
                'service_id' => 2, // ID của service liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'combo_id' => 1, // ID của combo liên kết
                'service_id' => 3, // ID của service liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // shop 1 combo 2
            [
                'combo_id' => 2, // ID của combo liên kết
                'service_id' => 1, // ID của service liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'combo_id' => 2, // ID của combo liên kết
                'service_id' => 2, // ID của service liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'combo_id' => 2, // ID của combo liên kết
                'service_id' => 3, // ID của service liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'combo_id' => 2, // ID của combo liên kết
                'service_id' => 7, // ID của service liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'combo_id' => 2, // ID của combo liên kết
                'service_id' => 8, // ID của service liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // shop 2
            [
                'combo_id' => 3, // ID của combo liên kết
                'service_id' => 1, // ID của service liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'combo_id' => 3, // ID của combo liên kết
                'service_id' => 2, // ID của service liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'combo_id' => 3, // ID của combo liên kết
                'service_id' => 3, // ID của service liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // shop 1 combo 2
            [
                'combo_id' => 4, // ID của combo liên kết
                'service_id' => 1, // ID của service liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'combo_id' => 4, // ID của combo liên kết
                'service_id' => 2, // ID của service liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'combo_id' => 4, // ID của combo liên kết
                'service_id' => 3, // ID của service liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'combo_id' => 4, // ID của combo liên kết
                'service_id' => 7, // ID của service liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'combo_id' => 4, // ID của combo liên kết
                'service_id' => 8, // ID của service liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // shop 3
            [
                'combo_id' => 5, // ID của combo liên kết
                'service_id' => 1, // ID của service liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'combo_id' => 5, // ID của combo liên kết
                'service_id' => 2, // ID của service liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'combo_id' => 5, // ID của combo liên kết
                'service_id' => 3, // ID của service liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // shop 1 combo 2
            [
                'combo_id' => 6, // ID của combo liên kết
                'service_id' => 1, // ID của service liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'combo_id' => 6, // ID của combo liên kết
                'service_id' => 2, // ID của service liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'combo_id' => 6, // ID của combo liên kết
                'service_id' => 3, // ID của service liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'combo_id' => 6, // ID của combo liên kết
                'service_id' => 7, // ID của service liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'combo_id' => 6, // ID của combo liên kết
                'service_id' => 8, // ID của service liên kết
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ];

        DB::table('combo_services')->insert($comboServices);
    }
}
