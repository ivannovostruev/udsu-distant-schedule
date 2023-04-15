<?php

namespace App\Repositories;

use App\Models\Schedule\Color;

class ColorRepository extends BaseRepository
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Color::class;
    }

    /**
     * @return mixed
     */
    public function getAllWithPaginate(): mixed
    {
        return Color::orderByDesc('id')->paginate(10);
    }
}
