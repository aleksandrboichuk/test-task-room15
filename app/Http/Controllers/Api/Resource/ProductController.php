<?php

namespace App\Http\Controllers\Api\Resource;

use App\Helpers\Response;
use App\Http\Requests\Resource\Product\ProductStoreRequest;
use App\Http\Requests\Resource\Product\ProductUpdateRequest;
use App\Services\Resource\BaseResourceService;
use App\Services\Resource\ProductResourceService;
use Illuminate\Http\JsonResponse;

class ProductController extends ResourceController
{
    public function __construct()
    {
        parent::__construct(new ProductResourceService);
    }
}
