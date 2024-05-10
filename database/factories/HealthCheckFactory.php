<?php

namespace Database\Factories;

use App\Models\HealthCheck;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<HealthCheck> */
class HealthCheckFactory extends Factory
{
    protected $model = HealthCheck::class;

    public function definition(): array
    {
        return [
            'owner' => $this->faker->uuid(),
            'db' => $this->faker->boolean(),
            'cache' => $this->faker->boolean(),
        ];
    }

}
