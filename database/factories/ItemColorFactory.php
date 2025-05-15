<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ItemColor;

class ItemColorFactory extends Factory
{
    protected $model = ItemColor::class;

    public function definition(): array
    {
        return [
            'name' => fake()->safeColorName(),
            'item_id' => fake()->numberBetween(1, 10), // Assuming you have 10 items
        ];
    }
}
