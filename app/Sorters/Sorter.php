<?php

namespace App\Sorters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class Sorter
{
    protected int $order;

    protected Request $request;

    protected Builder $builder;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;

        $this->setOrder($request);
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function sort(Builder $builder): Builder
    {
        $this->builder = $builder;

        return $this->executeSortMethod();
    }

    /**
     * Если требуется - переопределить!
     *
     * @return Builder
     */
    abstract protected function executeSortMethod(): Builder;

    /**
     * @param Request $request
     */
    protected function setOrder(Request $request)
    {
        $this->order = (int) $request->query('order', 0);
    }

    /**
     * @return int
     */
    public function getOrder(): int
    {
        return $this->order;
    }
}
