<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CurrencyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->text('10'),
            'symbol' => Str::random(2),
        ];
    }
}
