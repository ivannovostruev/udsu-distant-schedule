<?php

namespace App\Http\Controllers\Dashboard;

use App\DataCollectors\Exceptions\DataCollectorException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

trait LessonControllerTrait
{
    /**
     * @return string
     */
    protected function getApproveAbility(): string
    {
        return $this->abilities->approve();
    }

    /**
     * @param Request $request
     * @return array
     * @throws DataCollectorException
     */
    private function getApproveData(Request $request): array
    {
        return $this->dataCollector->getApproveData($request);
    }

    /**
     * @param Request $request
     * @param Model|null $model
     * @return Application|Factory|View
     */
    protected function getFastCreateView(Request $request, ?Model $model = null): Factory|View|Application
    {
        return view($this->getFastCreateViewName(), $this->getFastCreateData($request, $model));
    }

    /**
     * @return string
     */
    protected function getFastCreateViewName(): string
    {
        return $this->viewNames->fastCreate();
    }

    /**
     * @param Request $request
     * @param Model|null $model
     * @return array
     */
    protected function getFastCreateData(Request $request, ?Model $model = null): array
    {
        return $this->dataCollector->getFastCreateViewData($request, $model);
    }
}
