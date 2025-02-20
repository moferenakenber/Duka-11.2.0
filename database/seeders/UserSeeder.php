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
                'created_by' => 1, // Assuming user with ID 1 is creating the record
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Mili',
                'last_name' => 'Hunetaw',
                'phone_number' => '0912344867',
                'email' => 'mili.hunetaw@gmail.com',
                'email_verified_at' => now(),
                'role' => 'admin',
                'password' => Hash::make('12345678'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'created_by' => 1, // Assuming user with ID 1 is creating the record
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Gelila',
                'last_name' => 'Mesfin',
                'phone_number' => '0912344567',
                'email' => 'gm@gmail.com',
                'email_verified_at' => now(),
                'role' => 'seller',
                'password' => Hash::make('12345678'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'created_by' => 1, // Assuming user with ID 1 is creating the record
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Sultan',
                'last_name' => 'Sultan',
                'phone_number' => '0914344567',
                'email' => 'su@gmail.com',
                'email_verified_at' => now(),
                'role' => 'stock_keeper',
                'password' => Hash::make('12345678'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'created_by' => 1, // Assuming user with ID 1 is creating the record
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Amen',
                'last_name' => 'Biniyam',
                'phone_number' => '0914344267',
                'email' => 'amen@gmail.com',
                'email_verified_at' => now(),
                'role' => 'user',
                'password' => Hash::make('12345678'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'created_by' => 1, // Assuming user with ID 1 is creating the record
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Admin',
                'last_name' => 'User',
                'phone_number' => '0943754832',
                'email' => 'admin@admin.com',
                'email_verified_at' => now(),
                'role' => 'admin',
                'password' => Hash::make('12345678'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'created_by' => 1, // Assuming user with ID 1 is creating the record
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Seller',
                'last_name' => 'User',
                'phone_number' => '0947278489',
                'email' => 'seller@seller.com',
                'email_verified_at' => now(),
                'role' => 'seller',
                'password' => Hash::make('12345678'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'created_by' => 1, // Assuming user with ID 1 is creating the record
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Stoke_keeper',
                'last_name' => 'User',
                'phone_number' => '0911239154',
                'email' => 'stockkeeper@stockkeeper.com',
                'email_verified_at' => now(),
                'role' => 'stock_keeper',
                'password' => Hash::make('12345678'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'created_by' => 1, // Assuming user with ID 1 is creating the record
                'updated_at' => now(),
            ],
            [
                'first_name' => 'User',
                'last_name' => 'User',
                'phone_number' => '0953827843',
                'email' => 'user@user.com',
                'email_verified_at' => now(),
                'role' => 'user',
                'password' => Hash::make('12345678'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'created_by' => 1, // Assuming user with ID 1 is creating the record
                'updated_at' => now(),
            ],
            // There is also a visitor which i different from a user (a user is someone that had signed up).
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
