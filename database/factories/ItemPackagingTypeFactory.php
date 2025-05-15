<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ItemPackagingType;

class ItemPackagingTypeFactory extends Factory
{
    protected $model = ItemPackagingType::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['Box', 'Bag', 'Bottle']),
        ];
    }
}

