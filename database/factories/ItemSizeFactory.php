<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ItemSize;

class ItemSizeFactory extends Factory
{
    protected $model = ItemSize::class;

    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Small', 'Medium', 'Large', 'XL']),
            'image_path' => fake()->imageUrl(200, 200, 'abstract', true), // or set a placeholder
            'item_id' => fake()->numberBetween(1, 10), // Assuming you have 10 items
        ];
    }
}
