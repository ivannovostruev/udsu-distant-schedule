<?php

namespace App\Repositories;

use App\Models\Schedule\Reason;
use App\Sorters\ReasonSorter;
use Illuminate\Support\Collection;

class ReasonRepository extends BaseRepository
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Reason::class;
    }

    /**
     * @param ReasonSorter $sorter
     * @return mixed
     */
    public function getAllWithPaginate(ReasonSorter $sorter): mixed
    {
        return Reason::sort($sorter)
            ->paginate(10)
            ->withQueryString();
    }

    /**
     * @return Collection
     */
    public function getTimeslotForGrid(): Collection
    {
        $columns = ['id', 'shortname', 'name', 'type'];

        return Reason::select($columns)->orderBy('id')->get();
    }
}
