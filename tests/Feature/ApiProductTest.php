<?php

namespace Tests\Feature;

use App\Models\Currency;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_successful_product_creation()
    {
        $response = $this->postJson('/api/products', [
            'title' => 'Test Product',
            'price' => 100,
            'currency_id' => $this->currencyId,
        ], [
            'Authorization' => 'Bearer ' . $this->token,
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'title',
                'price',
                'currency_id',
            ]);
    }

    public function test_unsuccessful_product_creation_validation_error()
    {
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);

        $response = $this->postJson('/api/products', [
            'price' => 100,
            'currency_id' => $this->currencyId,
        ], [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['title']);
    }

    public function test_successful_product_update()
    {
        $response = $this->putJson("/api/products/$this->productId", [
            'title' => 'Updated Product',
            'price' => 150,
            'currency_id' => $this->currencyId,
        ], [
            'Authorization' => 'Bearer ' . $this->token,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'id' => $this->productId,
                'title' => 'Updated Product',
                'price' => 150,
            ]);
    }

    public function test_unsuccessful_product_update_invalid_product_id()
    {
        $response = $this->putJson('/api/products/123123', [
            'title' => 'Updated Product',
            'price' => 150,
            'currency_id' => $this->currencyId,
        ], [
            'Authorization' => 'Bearer ' . $this->token,
        ]);

        $response->assertStatus(404);
    }

    public function test_unsuccessful_product_update_validation_error()
    {
        $response = $this->putJson("/api/products/$this->productId", [
            'title' => 'Updated Product',
            'price' => -100,
            'currency_id' => $this->currencyId,
        ], [
            'Authorization' => 'Bearer ' . $this->token,
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['price']);
    }
}
