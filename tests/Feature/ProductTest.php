<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_page_success(): void
    {
        $this->actingAs(auth()->user())
            ->get(route('products.index'))
            ->assertStatus(200)
            ->assertViewHas('items');
    }

    public function test_create_page_success(): void
    {
        $this->actingAs(auth()->user())
            ->get(route('products.create'))
            ->assertViewHas(['currencies'])
            ->assertStatus(200);
    }

    public function test_store_request_success(): void
    {
        $this->actingAs(auth()->user())
            ->post(route('products.store'),
                [
                    'title' => fake()->title(),
                    'price' => fake()->numberBetween(0, 1000),
                    'currency_id' => $this->currencyId,
                ]
            )
            ->assertSessionHasNoErrors()
            ->assertStatus(302);
    }

    public function test_edit_page_success(): void
    {
        $this->actingAs(auth()->user())
            ->get(route('products.edit', [$this->productId]))
            ->assertViewHas(['item', 'currencies'])
            ->assertStatus(200);
    }

    public function test_show_page_success(): void
    {
        $this->actingAs(auth()->user())
            ->get(route('products.show', [$this->productId]))
            ->assertStatus(200);
    }

    public function test_update_request_success(): void
    {
        $this->actingAs(auth()->user())
            ->put(
                route('products.update', [$this->productId]),
                [
                    'title' => fake()->word(),
                    'price' => fake()->numberBetween(0, 1000),
                    'currency_id' => $this->currencyId,
                ]
            )
            ->assertSessionHasNoErrors()
            ->assertStatus(302);
    }

    public function test_update_request_with_validation_errors(): void
    {
        $this->validationErrorsTest(
            route('products.update', [$this->productId]),
            'put',
            [
                'title' => 'n',
                'price' => -1,
                'currency_id' => 0,
            ],
            [
                'title' =>['The title field must be at least 3 characters.'],
                'price' => ['The price field must be at least 0.'],
                'currency_id' => ['The selected currency id is invalid.'],
            ],
            auth()->user()
        );
    }

    public function test_destroy_request_success(): void
    {
        $this->actingAs(auth()->user())
            ->delete(route('products.destroy', [$this->productId]))
            ->assertStatus(302);
    }
}
