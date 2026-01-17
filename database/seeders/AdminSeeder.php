<?php

namespace Database\Seeders;

use App\Models\Admin\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'id' => '12345678901234',
            'fname' => 'Admin',
            'lname' => 'Test',
            'email' => 'admin@test.com',
            'phone' => '01012345678',
            'password' => Hash::make('123456'),
            'is_supper' => true,
            'joined_at' => now(),
        ]);

        Admin::create([
            'id' => '12345578901234',
            'fname' => 'Admin',
            'lname' => 'Test',
            'email' => 'admin1@test.com',
            'phone' => '01012345678',
            'password' => Hash::make('123456'),
            'is_supper' => true,
            'joined_at' => now(),
        ]);
    }
}
