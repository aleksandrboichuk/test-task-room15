<?php

namespace App\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface ResourceInterface
{
    public function list(int $perPage = 10): LengthAwarePaginator;

    public function show(int $id): Model|null;

    public function create(array $data): Model|Builder;

    public function update(int $id, array $data): bool|int|null;

    public function delete(int $id): bool|null;
}
