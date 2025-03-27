<?php

namespace App\Http\Controllers\Api\Resource;

use App\Helpers\Response;
use App\Http\Requests\Resource\Product\ProductStoreRequest;
use App\Http\Requests\Resource\Product\ProductUpdateRequest;
use App\Services\Resource\BaseResourceService;
use App\Services\Resource\ProductResourceService;
use Illuminate\Http\JsonResponse;

abstract class ResourceController
{
    public function __construct(
        protected BaseResourceService $service
    )
    {}

    public function index(): JsonResponse
    {
        return Response::success((array)$this->service->list());
    }

    public function show(int $id): JsonResponse
    {
        $item = $this->service->show($id);

        if(!$item){
            return Response::notFound();
        }

        return Response::success($item->toArray());
    }

    public function store(ProductStoreRequest $request): JsonResponse
    {
        return Response::success($this->service->create($request->validated())->toArray());
    }

    public function update(int $id, ProductUpdateRequest $request): JsonResponse
    {
        $product = $this->service->update($id, $request->validated());

        if(!$product){
            return Response::notFound();
        }

        return Response::success($product->toArray());
    }

    public function destroy(int $id): JsonResponse
    {
        $result = $this->service->delete($id);

        return Response::success(compact('result'));
    }
}
