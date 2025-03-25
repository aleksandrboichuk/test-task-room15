<?php

namespace App\Repositories;

use App\Models\Currency;

class CurrencyRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(new Currency);
    }
}
