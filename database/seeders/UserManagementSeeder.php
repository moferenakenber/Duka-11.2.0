<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserManagement;

class UserManagementSeeder extends Seeder
{
    public function run()
    {
        UserManagement::factory(10)->create();
    }
}