<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemOwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $items = Item::all();

        if ($users->isEmpty() || $items->isEmpty()) {
            $this->command->warn('No users or items found. Seed users and items first.');
            return;
        }

        // You can seed multiple ownerships per item
        foreach ($items as $item) {
            // Choose 1–3 random users for each item
            $owners = $users->random(rand(1, 3));

            foreach ($owners as $user) {
                DB::table('item_owners')->updateOrInsert(
                    ['user_id' => $user->id, 'item_id' => $item->id],
                    [
                        'name' => $user->name,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]
                );
            }
        }

        $this->command->info('Item owners seeded successfully.');
    }
}
