<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'id' => $this->faker->word(),
            'userId' => $this->faker->word(),
            'customerId' => $this->faker->word(),
            'sessionId' => $this->faker->word(),
            'token' => $this->faker->word(),
            'status' => $this->faker->word(),
            'subTotal' => $this->faker->word(),
            'itemDiscount' => $this->faker->word(),
            'tax' => $this->faker->word(),
            'shipping' => $this->faker->word(),
            'total' => $this->faker->word(),
            'promo' => $this->faker->word(),
            'discount' => $this->faker->word(),
            'grandTotal' => $this->faker->word(),
            'createdAt' => $this->faker->word(),
            'updatedAt' => $this->faker->word(),
            'content' => $this->faker->word(),
        ];
    }
}