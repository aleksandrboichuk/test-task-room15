<?php

namespace App\Http\Controllers\Resource;

use App\Http\Requests\Resource\ProductStoreRequest;
use App\Http\Requests\Resource\ProductUpdateRequest;
use App\Services\Resource\ProductResourceService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class ProductController extends ResourceController
{
    public function __construct(
        protected ProductResourceService $productResourceService
    )
    {
        parent::__construct($productResourceService, 'product');
    }

    public function index(): View|Application|Factory
    {
        return view("$this->entity.resource.index", [
            'items' => $this->service->list()
        ]);
    }

    public function store(ProductStoreRequest $request): RedirectResponse
    {
        try{

            if($this->service->create($request->validated())){
                return redirect()->route("$this->entity.index");
            }

        }catch (\Exception $exception){
            // logging
        }

        return back()->withErrors(['system' => "Something went wrong, try again later."]);
    }

    public function update(ProductUpdateRequest $request, string $id): RedirectResponse
    {
        try{

            if($this->service->update($id, $request->validated())){
                return redirect()->route('product.index');
            }

        }catch (\Exception $exception){
            // logging
        }

        return back()->withErrors(['system' => "Something went wrong, try again later."]);
    }
}
