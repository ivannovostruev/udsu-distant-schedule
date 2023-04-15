<?php

namespace App\Sorters;

use Illuminate\Database\Eloquent\Builder;

class UserSorter extends Sorter
{
    protected function executeSortMethod(): Builder
    {
        return match ($this->order) {
            1 => $this->idAsc(),
            2 => $this->nameAsc(),
            3 => $this->nameDesc(),
            4 => $this->emailAsc(),
            5 => $this->emailDesc(),
            default => $this->idDesc(),
        };
    }

    private function idAsc(): Builder
    {
        return $this->builder->orderBy('id');
    }

    private function idDesc(): Builder
    {
        return $this->builder->orderByDesc('id');
    }

    private function nameAsc(): Builder
    {
        return $this->builder->orderBy('name');
    }

    private function nameDesc(): Builder
    {
        return $this->builder->orderByDesc('name');
    }

    private function emailAsc(): Builder
    {
        return $this->builder->orderBy('email');
    }

    private function emailDesc(): Builder
    {
        return $this->builder->orderByDesc('email');
    }
}
