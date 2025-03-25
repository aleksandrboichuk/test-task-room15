<?php

namespace App\Http\Controllers\Api\Resource;

use App\Helpers\Response;
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

    public function store(array $data): JsonResponse
    {
        return Response::success($this->productResourceService->create($data)->toArray());
    }

    public function update(int $id, array $data): JsonResponse
    {
        $result = $this->productResourceService->update($id, $data);

        return Response::success(compact('result'));
    }

    public function destroy(int $id): JsonResponse
    {
        $result = $this->productResourceService->delete($id);

        return Response::success(compact('result'));
    }
}
