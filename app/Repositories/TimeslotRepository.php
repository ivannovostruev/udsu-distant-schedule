<?php

namespace App\Repositories;

use App\Models\Schedule\Timeslot;
use Illuminate\Support\Collection;

class TimeslotRepository extends BaseRepository
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Timeslot::class;
    }

    /**
     * @return mixed
     */
    public function getAllWithPaginate(): mixed
    {
        return Timeslot::paginate(10);
    }

    /**
     * @return Collection
     */
    public function getTimeslotForGrid(): Collection
    {
        $columns = ['id', 'name', 'start_time', 'end_time'];

        return Timeslot::select($columns)->orderBy('id')->get();
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->startCondition()
            ->orderBy('start_time')
            ->get();
    }
}
