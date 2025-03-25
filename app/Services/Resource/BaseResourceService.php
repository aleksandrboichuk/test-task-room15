<?php

namespace App\Services\Resource;

use App\Interfaces\ResourceInterface;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BaseResourceService implements ResourceInterface
{
    protected BaseRepository $repository;

    public function list(int $perPage = 10): LengthAwarePaginator
    {
        return $this->repository->list($perPage);
    }

    public function show(int $id): Model|null
    {
        return $this->repository->find($id);
    }

    public function create(array $data): Model
    {
        return $this->repository->create($data);
    }

    public function update(int $id, array $data): bool|int|null
    {
        return $this->repository->update($id, $data);
    }

    public function delete(int $id): bool|null
    {
        return $this->repository->delete($id);
    }

    public function setRepository(BaseRepository $repository): void
    {
        $this->repository = $repository;
    }
}
