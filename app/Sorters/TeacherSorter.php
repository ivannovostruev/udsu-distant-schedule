<?php

namespace App\Sorters;

use Illuminate\Database\Eloquent\Builder;

class TeacherSorter extends Sorter
{
    protected function executeSortMethod(): Builder
    {
        return match ($this->order) {
            1 => $this->idAsc(),
            2 => $this->fullnameAsc(),
            3 => $this->fullnameDesc(),
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

    private function fullnameAsc(): Builder
    {
        return $this->builder->orderBy('full_name');
    }

    private function fullnameDesc(): Builder
    {
        return $this->builder->orderByDesc('full_name');
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
