<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use \App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'first_name' => 'Yonathan',
                'last_name' => 'Hunetaw',
                'phone_number' => '1234587890',
                'email' => 'yo@yo.com',
                'email_verified_at' => now(),
                'role' => 'admin',
                'password' => Hash::make('12345678'), // Using Hash to encrypt the password
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Mili',
                'last_name' => 'Hunetaw',
                'phone_number' => '0912344567',
                'email' => 'mili.hunetaw@gmail.com',
                'email_verified_at' => now(),
                'role' => 'admin',
                'password' => Hash::make('12345678'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // You can add more users as needed
        ]);

        // Use the factory to generate additional users
        User::factory(10)->create(); // Create 10 additional users

    }
}


// DB::table('users')->insert([
//     [
//         'first_name' => 'Yonathan',
//         'last_name' => 'Hunetaw',
//         'phone_number' => '1234587890',
//         'email' => 'yo@yo.com',
//         'email_verified_at' => now(),
//         'role' => 'admin',
//         'password' => Hash::make('password123'), // Using Hash to encrypt the password
//         'remember_token' => Str::random(10),
//         'created_at' => now(),
//         'updated_at' => now(),
//     ],
//     [
//         'first_name' => 'Mili',
//         'last_name' => 'Hunetaw',
//         'phone_number' => '0912344567',
//         'email' => 'mili.hunetaw@gmail.com',
//         'email_verified_at' => now(),
//         'role' => 'admin',
//         'password' => Hash::make('12345678'),
//         'remember_token' => Str::random(10),
//         'created_at' => now(),
//         'updated_at' => now(),
//     ],
//     // You can add more users as needed
// ]);