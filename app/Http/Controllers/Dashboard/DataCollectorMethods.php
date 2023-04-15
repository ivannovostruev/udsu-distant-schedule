<?php

namespace App\Http\Controllers\Dashboard;

use App\DataCollectors\Exceptions\DataCollectorException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

trait DataCollectorMethods
{
    /**
     * @param Request|null $request
     * @return array
     */
    protected function getIndexViewData(?Request $request = null): array
    {
        return $this->dataCollector->getIndexViewData($request);
    }

    /**
     * @param Model $model
     * @return array
     */
    protected function getShowViewData(Model $model): array
    {
        return $this->dataCollector->getShowViewData($model);
    }

    /**
     * @param Model|null $model
     * @return array
     */
    protected function getCreateViewData(?Model $model = null): array
    {
        return $this->dataCollector->getCreateViewData($model);
    }

    /**
     * @param Model $model
     * @return array
     */
    protected function getEditViewData(Model $model): array
    {
        return $this->dataCollector->getEditViewData($model);
    }

    /**
     * @param Request $request
     * @return array
     * @throws DataCollectorException
     */
    protected function getStoreData(Request $request): array
    {
        return $this->dataCollector->getStoreData($request);
    }

    /**
     * @param Request $request
     * @return array
     * @throws DataCollectorException
     */
    protected function getUpdateData(Request $request): array
    {
        return $this->dataCollector->getUpdateData($request);
    }
}
