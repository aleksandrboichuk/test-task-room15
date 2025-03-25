<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->unique()->word(),
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'currency_id' => 1,
        ];
    }
}
