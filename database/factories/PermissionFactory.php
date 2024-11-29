<?php

namespace Database\Factories;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionFactory extends Factory
{
    protected $model = Permission::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'label' => $this->faker->unique()->word,
            'pretty_label' => $this->faker->sentence(2),
            'description' => $this->faker->sentence,
        ];
    }
}
