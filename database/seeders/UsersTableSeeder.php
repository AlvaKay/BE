<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'user_name' => 'Admin',
                'user_password' => Hash::make('123'),
                'user_phone' => '123456789',
                'user_email' => 'admin@gmail.com',
                'user_type' => null,
                'is_admin' => true,
                'is_user' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_name' => 'Shop 1',
                'user_password' => Hash::make('s123'),
                'user_phone' => '987654321',
                'user_email' => 's1@example.com',
                'user_type' => 'B',
                'is_admin' => false,
                'is_user' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_name' => 'Shop 2',
                'user_password' => Hash::make('s123'),
                'user_phone' => '987654321',
                'user_email' => 's2@example.com',
                'user_type' => 'B',
                'is_admin' => false,
                'is_user' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_name' => 'Shop 3',
                'user_password' => Hash::make('s123'),
                'user_phone' => '987654321',
                'user_email' => 's3@example.com',
                'user_type' => 'B',
                'is_admin' => false,
                'is_user' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_name' => 'Customer 1',
                'user_password' => Hash::make('c123'),
                'user_phone' => '987654321',
                'user_email' => 'c1@example.com',
                'user_type' => 'C',
                'is_admin' => false,
                'is_user' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_name' => 'Customer 2',
                'user_password' => Hash::make('c123'),
                'user_phone' => '987654321',
                'user_email' => 'c2@example.com',
                'user_type' => 'C',
                'is_admin' => false,
                'is_user' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('users')->insert($users);
    }
}
