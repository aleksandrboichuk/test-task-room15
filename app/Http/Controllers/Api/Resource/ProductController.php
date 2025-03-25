<?php

namespace App\Http\Controllers\Api\Resource;

use App\Helpers\Response;
use App\Http\Requests\Resource\ProductStoreRequest;
use App\Http\Requests\Resource\ProductUpdateRequest;
use App\Services\Resource\ProductResourceService;
use Illuminate\Http\JsonResponse;

class ProductController
{
    public function __construct(
        protected ProductResourceService $productResourceService
    )
    {}

    public function index(): JsonResponse
    {
        return Response::success((array)$this->productResourceService->list());
    }

    public function show(int $id): JsonResponse
    {
        $item = $this->productResourceService->show($id);

        if(!$item){
            return Response::notFound();
        }

        return Response::success($item->toArray());
    }

    public function store(ProductStoreRequest $request): JsonResponse
    {
        return Response::success($this->productResourceService->create($request->validated())->toArray());
    }

    public function update(int $id, ProductUpdateRequest $request): JsonResponse
    {
        $product = $this->productResourceService->update($id, $request->validated());

        if(!$product){
            return Response::notFound();
        }

        return Response::success($product->toArray());
    }

    public function destroy(int $id): JsonResponse
    {
        $result = $this->productResourceService->delete($id);

        return Response::success(compact('result'));
    }
}
