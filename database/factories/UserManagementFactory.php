<?php

namespace Database\Factories;

use App\Models\UserManagement;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserManagementFactory extends Factory
{
    protected $model = UserManagement::class;

    public function definition()
    {
        return [
            'id' => $this->faker->word(),
            'user_id' => $this->faker->word(),
            'permissions' => $this->faker->word(),
            'login_history' => $this->faker->word(),
            'status' => $this->faker->word(),
            'payroll_id' => $this->faker->word(),
            'payment_history_id' => $this->faker->word(),
            'created_at' => $this->faker->word(),
            'updated_at' => $this->faker->word(),
        ];
    }
}