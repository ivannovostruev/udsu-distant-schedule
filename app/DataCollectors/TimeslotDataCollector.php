<?php

namespace App\DataCollectors;

use App\Repositories\TimeslotRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * @property TimeslotRepository $repository
 */
class TimeslotDataCollector extends BaseDataCollector
{
    use StoreAndUpdateDataGetters;

    /**
     * @param Request|null $request
     * @return array
     */
    public function getIndexViewData(?Request $request = null): array
    {
        $this->viewData['paginator'] = $this->getTimeslotsWithPaginate();

        return $this->viewData;
    }

    /**
     * @param Model $model
     * @return array
     */
    public function getShowViewData(Model $model): array
    {
        $this->viewData['timeslot'] = $model;

        return $this->viewData;
    }

    /**
     * @param Model|null $model
     * @return array
     */
    public function getCreateViewData(?Model $model = null): array
    {
        $this->viewData['timeslot'] = $model;

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
    private function getTimeslotsWithPaginate(): mixed
    {
        return $this->repository->getAllWithPaginate();
    }
}
