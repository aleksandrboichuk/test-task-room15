<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $currency = Currency::factory()->create();

        Product::factory()->count(10)->create([
            'currency_id' => $currency->id,
        ]);
    }
}
