<?php

namespace Tests;

use App\Models\Currency;
use App\Models\Product;
use App\Models\User;
use Database\Factories\CurrencyFactory;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

abstract class TestCase extends BaseTestCase
{
    protected string $token;

    protected int $productId;

    protected int $currencyId;

    protected function validationErrorsTest(string $uri, string $method, array $data, array $assertErrors, mixed $actingAs = null): void
    {
        if($actingAs){
            $response = $this->actingAs($actingAs)->{$method}($uri, $data);
        }else{
            $response = $this->{$method}($uri, $data);
        }

        $response->assertSessionHasErrors(array_keys($assertErrors));

        $errors = session('errors');

        foreach ($assertErrors as $field => $assertError) {
            foreach ($assertError as $assertErrorMessage) {
                $this->assertContains($assertErrorMessage, $errors->get($field));
            }
        }

        $response->assertStatus(302);
    }

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        $this->token = JWTAuth::fromUser($this->user);

        auth()->loginUsingId($this->user->id);

        $this->currencyId = Currency::factory()->create()->id;

        $this->productId = Product::factory()->create([
            'currency_id' => $this->currencyId
        ])->id;
    }
}
