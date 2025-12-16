<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Store;
use App\Models\Customer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $stores = Store::all();

        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone_number' => $this->faker->unique()->regexify('[0-9]{10}'), // 10-digit phone
            'city' => $this->faker->randomElement([
                'Addis Ababa',
                'Adama',
                'Dire Dawa',
                'Bahir Dar',
                'Bishoftu',
                'Dessie',
                'Gonder',
                'Jimma',
                'Jijiga',
                'Mekele',
                'Shashamanea'
            ]),
            'created_by' => User::all()->random()->id, // Random user creator
            'store_id' => $stores->isNotEmpty() ? $stores->random()->id : null, // Random store if exists
            'tin_number' => sprintf('%010d', rand(1000000000, 9999999999)), // 10-digit TIN
        ];
    }
}
