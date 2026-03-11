<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //users

        \DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin@123!'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Game',
                'email' => 'game@example.com',
                'password' => Hash::make('password@123!'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
