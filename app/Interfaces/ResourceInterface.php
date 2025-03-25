<?php

namespace App\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ResourceInterface
{
    public function all(): Collection;

    public function list(int $perPage = 10): LengthAwarePaginator;

    public function show(int $id): Model|null;

    public function create(array $data): Model|Builder;

    public function update(int $id, array $data): Model|false;

    public function delete(int $id): bool|null;
}
