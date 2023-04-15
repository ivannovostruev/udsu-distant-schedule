<?php

namespace App\ModelServices;

use App\ModelServices\Exceptions\ModelServiceException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\MessageBag;

abstract class ModelService
{
    public MessageBag $messageBag;

    /**
     * @param MessageBag $messageBag
     */
    public function __construct(MessageBag $messageBag)
    {
        $this->messageBag = $messageBag;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->messageBag->get('errors');
    }

    /**
     * @param Model $model
     * @param array $data
     * @return mixed
     * @throws ModelServiceException
     */
    public function create(Model $model, array $data): void
    {
        $model->create($data);
    }

    /**
     * @param Model $model
     * @param array $data
     * @return void
     * @throws ModelServiceException
     */
    public function update(Model $model, array $data): void
    {
        $model->update($data);
    }

    /**
     * @param Model $model
     * @return bool|null
     */
    public function delete(Model $model): ?bool
    {
        return $model->delete();
    }
}
