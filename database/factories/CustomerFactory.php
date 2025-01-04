<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

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
    protected $model = \App\Models\Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone_number' => $this->faker->unique()->regexify('[0-9]{10}'), // Use regex for phone number
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
            'created_by' => User::all()->random()->id, // Randomly assign a user
        ];
    }
}
