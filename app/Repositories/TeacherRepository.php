<?php

namespace App\Repositories;

use App\Models\Schedule\Teacher;
use App\QueryFilters\TeacherFilter;
use App\Sorters\TeacherSorter;

class TeacherRepository extends BaseRepository
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Teacher::class;
    }

    /**
     * @param TeacherFilter $filter
     * @param TeacherSorter $sorter
     * @param int $perPage
     * @return mixed
     */
    public function getAllWithPaginate(
        TeacherFilter $filter,
        TeacherSorter $sorter,
        int $perPage
    ): mixed {
        return Teacher::filter($filter)
            ->sort($sorter)
            ->paginate($perPage)
            ->withQueryString();
    }
}
