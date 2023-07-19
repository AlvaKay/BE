<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'service_name' => 'Cắt tóc',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'service_name' => 'Cạo mặt',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'service_name' => 'Cạo râu',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'service_name' => 'Ngoáy tai',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'service_name' => 'Gội đầu',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'service_name' => 'Nhuộm tóc',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'service_name' => 'Đắp mặt nạ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'service_name' => 'Mát xa',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'service_name' => 'Lột mụn',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
            // Thêm thông tin của các dịch vụ khác tại đây
        ];

        DB::table('services')->insert($services);
    }
}
