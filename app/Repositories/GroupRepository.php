<?php

namespace App\Repositories;

use App\Models\Schedule\Group;
use App\QueryFilters\GroupFilter;
use App\Sorters\GroupSorter;

class GroupRepository extends BaseRepository
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Group::class;
    }

    /**
     * @param GroupFilter $filter
     * @param GroupSorter $sorter
     * @param int $perPage
     * @return mixed
     */
    public function getAllWithPaginate(
        GroupFilter $filter,
        GroupSorter $sorter,
        int $perPage
    ): mixed {
        return Group::filter($filter)
            ->sort($sorter)
            ->paginate($perPage)
            ->withQueryString();
    }
}
