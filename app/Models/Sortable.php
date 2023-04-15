<?php

namespace App\Models;

use App\Sorters\Sorter;
use Illuminate\Database\Eloquent\Builder;

trait Sortable
{
    /**
     * @param Builder $builder
     * @param Sorter $sorter
     * @return Builder
     */
    public function scopeSort(Builder $builder, Sorter $sorter): Builder
    {
        return $sorter->sort($builder);
    }
}
