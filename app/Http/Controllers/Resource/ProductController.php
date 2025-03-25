<?php

namespace App\Http\Controllers\Resource;

use App\Http\Requests\Resource\ProductStoreRequest;
use App\Http\Requests\Resource\ProductUpdateRequest;
use App\Services\Resource\CurrencyResourceService;
use App\Services\Resource\ProductResourceService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class ProductController extends ResourceController
{
    public function __construct(
        protected ProductResourceService $productResourceService,
        protected CurrencyResourceService $currencyResourceService
    )
    {
        parent::__construct($productResourceService, 'products');
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

    public function store(ProductStoreRequest $request): RedirectResponse
    {
        try{

            if($this->service->create($request->validated())){
                return redirect()->route("$this->entity.index");
            }

        }catch (\Exception $exception){
            dd($exception->getMessage());
            // logging
        }

        return back()->withInput()->withErrors(['system' => "Something went wrong, try again later."]);
    }

    public function update(ProductUpdateRequest $request, string $id): RedirectResponse
    {
        try{

            if($this->service->update($id, $request->validated())){
                return redirect()->route('products.index');
            }

        }catch (\Exception $exception){
            dd($exception->getMessage());
            // logging
        }

        return back()->withInput()->withErrors(['system' => "Something went wrong, try again later."]);
    }
}
