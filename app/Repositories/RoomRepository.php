<?php

namespace App\Repositories;

use App\Models\Schedule\Room;
use Illuminate\Support\Collection;

class RoomRepository extends BaseRepository
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Room::class;
    }

    /**
     * @return mixed
     */
    public function getAllWithPaginate(): mixed
    {
        return Room::paginate(15);
    }

    /**
     * @return Collection
     */
    public function getRoomsForGrid(): Collection
    {
        $columns = ['id', 'name'];

        return Room::select($columns)->orderBy('id')->get();
    }
}
