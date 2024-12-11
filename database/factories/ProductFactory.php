<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'id' => $this->faker->word(),
            'userId' => $this->faker->word(),
            'title' => $this->faker->word(),
            'metaTitle' => $this->faker->word(),
            'slug' => $this->faker->word(),
            'summary' => $this->faker->word(),
            'type' => $this->faker->word(),
            'sku' => $this->faker->word(),
            'price' => $this->faker->word(),
            'discount' => $this->faker->word(),
            'quantity' => $this->faker->word(),
            'shop' => $this->faker->word(),
            'createdAt' => $this->faker->word(),
            'updatedAt' => $this->faker->word(),
            'publishedAt' => $this->faker->word(),
            'startsAt' => $this->faker->word(),
            'endsAt' => $this->faker->word(),
            'content' => $this->faker->word(),
        ];
    }
}