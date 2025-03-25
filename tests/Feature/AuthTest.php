<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    protected string $loginEmail = 'example@test.com';

    public function test_registration_success(): void
    {
        $response = $this->registerRequest();

        $response->assertRedirect(route('home'));

        $response->assertStatus(302);
    }

    public function test_registration_with_validation_errors_name(): void
    {
        $this->validationErrorsTest(route('register'), 'post', [
            'name' => '12',
            'email' => fake()->unique()->email(),
            'password' => 'password',
            'password_confirmation' => 'password',
        ], [
            'name' => [
                'The name field must be at least 3 characters.',
                'The name field format is invalid.'
            ],
        ]);
    }

    public function test_registration_with_validation_errors_email(): void
    {
        $this->validationErrorsTest(route('register'), 'post', [
            'name' => fake()->name(),
            'email' => '12',
            'password' => 'password',
            'password_confirmation' => 'password',
        ], [
            'email' => [
                'The email field must be a valid email address.'
            ],
        ]);
    }

    public function test_registration_with_validation_errors_password(): void
    {
        $this->validationErrorsTest(route('register'), 'post', [
            'name' => fake()->name(),
            'email' => fake()->email(),
            'password' => '12',
            'password_confirmation' => 'password',
        ], [
            'password' => [
                'The password field must be at least 3 characters.',
                'The password field confirmation does not match.'
            ],
        ]);
    }

    public function test_login_success(): void
    {
        $this->flushSession();

        $this->registerRequest($this->loginEmail);

        $this->flushSession();

        $response = $this->post(route('login'), [
            'email' => $this->loginEmail,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('home'));

        $response->assertStatus(302);
    }

    public function test_login_with_validation_errors_email(): void
    {
        $this->flushSession();

        $this->validationErrorsTest(route('login'), 'post', [
            'email' => fake()->name(),
            'password' => 'password',
        ], [
            'email' => [
                'The email field must be a valid email address.',
            ],
        ]);
    }

    public function test_login_with_incorrect_credentials(): void
    {
        $this->flushSession();

        $this->validationErrorsTest(route('login'), 'post', [
            'email' => 'test2@gmai.com',
            'password' => 'password',
        ], [
            'email' => [
                'These credentials do not match our records.'
            ],
        ]);
    }

    protected function registerRequest(string|null $email = null): TestResponse
    {
        return $this->post(route('register'), [
            'name' => 'Name Last',
            'email' => $email ?? fake()->unique()->email(),
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
    }
}
