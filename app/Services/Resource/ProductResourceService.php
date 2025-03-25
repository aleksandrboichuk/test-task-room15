<?php

namespace App\Services\Resource;

use App\Repositories\ProductRepository;

class ProductResourceService extends BaseResourceService
{
    public function __construct()
    {
        $this->setRepository(new ProductRepository);
    }
}
