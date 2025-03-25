<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseRepository implements RepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->setModel($model);
    }

    public function setModel(Model $model): void
    {
        $this->model = $model;
    }

    public function find(int $id): Model|null
    {
        return $this->model->query()->find($id);
    }

    public function create(array $attributes): Model
    {
        $item = new $this->model;

        $item->fill($attributes);

        if(!$item->save()){
            throw new \Exception("Creation error ({$this->model->getTable()})");
        }

        return $item;
    }

    public function update(int $id, array $attributes): Model|false
    {
        $item = $this->find($id);

        if(!$item){
            return false;
        }

        $item->fill($attributes);

        if(!$item->save()){
            throw new \Exception("Update error ({$this->model->getTable()})");
        }

        return $item;
    }

    public function delete(int $id): bool
    {
       return $this->find($id)?->delete();
    }

    public function list(int $perPage = 10): LengthAwarePaginator
    {
        return $this->model->query()->paginate($perPage);
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function latest(): Model|null
    {
        return $this->model->query()->latest()->first();
    }
}
