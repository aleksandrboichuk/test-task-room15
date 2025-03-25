<?php

namespace App\Interfaces;

interface RegisterInterface
{
    public function register(array $credentials): bool;
}
