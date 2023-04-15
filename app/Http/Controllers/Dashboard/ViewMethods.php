<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

trait ViewMethods
{
    /**
     * @param Request|null $request
     * @return Application|Factory|View
     */
    protected function getIndexView(?Request $request = null): Factory|View|Application
    {
        return view($this->getIndexViewName(), $this->getIndexViewData($request));
    }

    /**
     * @param Model|null $model
     * @return Application|Factory|View
     */
    protected function getCreateView(?Model $model = null): View|Factory|Application
    {
        return view($this->getCreateViewName(), $this->getCreateViewData($model));
    }

    /**
     * @param Model $model
     * @return Application|Factory|View
     */
    protected function getShowView(Model $model): View|Factory|Application
    {
        return view($this->getShowViewName(), $this->getShowViewData($model));
    }

    /**
     * @param Model $model
     * @return Application|Factory|View
     */
    protected function getEditView(Model $model): View|Factory|Application
    {
        return view($this->getEditViewName(), $this->getEditViewData($model));
    }
}
