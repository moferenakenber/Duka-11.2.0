<?php

namespace Database\Seeders;

use App\Models\ItemCategory;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'first_name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Call other seeders here
        $this->call([
            UserSeeder::class,
            CustomerSeeder::class,
            ItemCategorySeeder::class,
            ItemColorSeeder::class,
            ItemSizeSeeder::class,
            ItemPackagingTypeSeeder::class,
            ItemSeeder::class,
            ItemInventoryLocationSeeder::class,
            ItemVariantSeeder::class,
            ItemImageSeeder::class,
            ItemOwnerSeeder::class,





        ]);
    }
}
