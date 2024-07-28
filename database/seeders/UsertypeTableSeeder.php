<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Seeder;

class UsertypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserType::truncate();

        UserType::insert([
            [
                'name' => 'User',
                'description' => 'người dùng',
            ],
            [
                'name' => 'Admin',
                'description' => 'quản trị viên',
            ],
            // [
            //     'name' => 'System',
            //     'description' => 'hệ thống',
            // ]
        ]);
    }
}

