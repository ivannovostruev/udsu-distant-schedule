<?php

namespace App\Sorters;

use Illuminate\Database\Eloquent\Builder;

class ReasonSorter extends Sorter
{
    protected function executeSortMethod(): Builder
    {
        return match ($this->order) {
            1 => $this->idAsc(),
            2 => $this->shortnameAsc(),
            3 => $this->shortnameDesc(),
            4 => $this->nameAsc(),
            5 => $this->nameDesc(),
            6 => $this->typeAsc(),
            7 => $this->typeDesc(),
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

    private function shortnameAsc(): Builder
    {
        return $this->builder->orderBy('shortname');
    }

    private function shortnameDesc(): Builder
    {
        return $this->builder->orderByDesc('shortname');
    }

    private function nameAsc(): Builder
    {
        return $this->builder->orderBy('name');
    }

    private function nameDesc(): Builder
    {
        return $this->builder->orderByDesc('name');
    }

    private function typeAsc(): Builder
    {
        return $this->builder->orderBy('type');
    }

    private function typeDesc(): Builder
    {
        return $this->builder->orderByDesc('type');
    }
}
