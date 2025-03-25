<?php

namespace App\Interfaces;

interface LoginInterface
{
    public function login(array $credentials): bool;
}
