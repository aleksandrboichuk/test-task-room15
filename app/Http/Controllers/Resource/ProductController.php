<?php

namespace App\Http\Controllers\Resource;

use App\Http\Requests\Resource\Product\ProductStoreRequest;
use App\Http\Requests\Resource\Product\ProductUpdateRequest;
use App\Services\Resource\CurrencyResourceService;
use App\Services\Resource\ProductResourceService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class ProductController extends ResourceController
{
    public function __construct(
        protected ProductResourceService $productResourceService,
        protected CurrencyResourceService $currencyResourceService
    )
    {
        parent::__construct(
            service: $productResourceService,
            entity: 'products',
            storeRequestClassName: ProductStoreRequest::class,
            updateRequestClassName: ProductUpdateRequest::class
        );
    }

    public function create(): View|Application|Factory
    {
        $currencies = $this->currencyResourceService->all();

        return view("$this->entity.resource.create", compact("currencies"));
    }

    public function show(int $id): View|Application|Factory
    {
        $item = $this->service->show($id);

        $item ?: abort(404);

        $currencies = $this->currencyResourceService->all();

        return view("$this->entity.resource.show", compact('item', 'currencies'));
    }

    public function edit(int $id): View|Application|Factory
    {
        $item = $this->service->show($id);

        $item ?: abort(404);

        $currencies = $this->currencyResourceService->all();

        return view("$this->entity.resource.edit", compact('item', 'currencies'));
    }
}
