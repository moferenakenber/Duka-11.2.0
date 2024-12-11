<?php

namespace Database\Factories;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition()
    {
        return [
            'id' => $this->faker->word(),
            'productId' => $this->faker->word(),
            'orderId' => $this->faker->word(),
            'sku' => $this->faker->word(),
            'price' => $this->faker->word(),
            'discount' => $this->faker->word(),
            'quantity' => $this->faker->word(),
            'createdAt' => $this->faker->word(),
            'updatedAt' => $this->faker->word(),
            'content' => $this->faker->word(),
        ];
    }
}