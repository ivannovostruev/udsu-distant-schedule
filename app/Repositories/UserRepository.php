<?php

namespace App\Repositories;

use App\Models\User;
use App\QueryFilters\UserFilter;
use App\Sorters\UserSorter;

class UserRepository extends BaseRepository
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return User::class;
    }

    /**
     * @param UserFilter $filter
     * @param UserSorter $sorter
     * @param int $perPage
     * @return mixed
     */
    public function getAllWithPaginate(
        UserFilter $filter,
        UserSorter $sorter,
        int $perPage
    ): mixed {
        return User::filter($filter)
            ->sort($sorter)
            ->paginate($perPage)
            ->withQueryString();
    }

    /**
     * @param int $externalId
     * @return mixed
     */
    public function getByExternalId(int $externalId): mixed
    {
        return $this->startCondition()
            ->where('external_id', $externalId)
            ->first();
    }
}
