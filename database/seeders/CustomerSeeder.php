<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use \App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // You can insert sample customers here, using a factory or manually
        DB::table('customers')->insert([
            [
                'first_name' => 'Abebe',
                'last_name' => 'Damtew',
                'email' => 'abebe.damtew@mail.com',
                'phone_number' => '0912345679',
                'city' => 'Addis Ababa',
                'created_by' => 1, // Assuming a user with ID 1 exists in the 'users' table
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Chala',
                'last_name' => 'Mulatu',
                'email' => 'chala.mulatu@mail.com',
                'phone_number' => '0912345678',
                'city' => 'Awassa',
                'created_by' => 2, // Assuming a user with ID 2 exists
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more customers as needed
        ]);
        // Use the factory to generate additional users
        Customer::factory(10)->create(); // Create 10 additional users
    }
}
