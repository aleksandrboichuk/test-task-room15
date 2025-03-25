<?php

namespace App\Services\Resource;

use App\Repositories\CurrencyRepository;

class CurrencyResourceService extends BaseResourceService
{
    public function __construct()
    {
        $this->setRepository(new CurrencyRepository);
    }
}
