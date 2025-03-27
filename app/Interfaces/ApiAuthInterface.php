<?php

namespace App\Interfaces;


interface ApiAuthInterface
{
    public function login(array $credentials): string|false;

    public function refresh(): string;

    public function logout(): bool;
}
