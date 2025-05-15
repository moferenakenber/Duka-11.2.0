<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackagingTypeSeeder extends Seeder
{
    public function run(): void
    {
        $packagingTypes = [
            ['name' => 'Piece', 'quantity' => 1],
            ['name' => 'Doz', 'quantity' => 12],
            ['name' => 'Bundle', 'quantity' => 10],
            ['name' => 'Packet', 'quantity' => 50],
            ['name' => 'Bag', 'quantity' => 100],
            ['name' => 'Wrapper', 'quantity' => 1],
            ['name' => 'Bottle', 'quantity' => 1],
            ['name' => 'Case', 'quantity' => 24],
            ['name' => 'Crate', 'quantity' => 1000],
            ['name' => 'Container', 'quantity' => 5000],
        ];

        DB::table('packaging_types')->insert([
            'packaging_details' => json_encode($packagingTypes),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
