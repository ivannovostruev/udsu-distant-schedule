<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected Model $model;

    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * @return string
     */
    abstract protected function getModelClass(): string;

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->startCondition();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id): mixed
    {
        return $this->startCondition()->find($id);
    }

    /**
     * @return Model
     */
    protected function startCondition(): Model
    {
        return clone $this->model;
    }
}
