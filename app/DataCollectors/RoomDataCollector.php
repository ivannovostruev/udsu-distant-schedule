<?php

namespace App\DataCollectors;

use App\Repositories\RoomRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * @property RoomRepository $repository
 */
class RoomDataCollector extends BaseDataCollector
{
    use StoreAndUpdateDataGetters;

    /**
     * @param Request|null $request
     * @return array
     */
    public function getIndexViewData(?Request $request = null): array
    {
        $this->viewData['paginator'] = $this->getRoomsWithPaginate();

        return $this->viewData;
    }

    /**
     * @param Model $model
     * @return array
     */
    public function getShowViewData(Model $model): array
    {
        $this->viewData['room'] = $model;

        return $this->viewData;
    }

    /**
     * @param Model|null $model
     * @return array
     */
    public function getCreateViewData(?Model $model = null): array
    {
        $this->viewData['room'] = $model;

        return $this->viewData;
    }

    /**
     * @param Model $model
     * @return array
     */
    public function getEditViewData(Model $model): array
    {
        return $this->getCreateViewData($model);
    }

    /**
     * @return mixed
     */
    private function getRoomsWithPaginate(): mixed
    {
        return $this->repository->getAllWithPaginate();
    }
}
