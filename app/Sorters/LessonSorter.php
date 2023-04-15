<?php

namespace App\Sorters;

use Illuminate\Database\Eloquent\Builder;

class LessonSorter extends Sorter
{
    protected function executeSortMethod(): Builder
    {
        return match ($this->order) {
            1 => $this->idAsc(),
            2 => $this->nameAsc(),
            3 => $this->nameDesc(),
            4 => $this->dateAsc(),
            5 => $this->dateDesc(),
            6 => $this->roomAsc(),
            7 => $this->roomDesc(),
            8 => $this->teacherAsc(),
            9 => $this->teacherDesc(),
            10 => $this->creatorAsc(),
            11 => $this->creatorDesc(),
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

    private function dateAsc(): Builder
    {
        return $this->builder->orderBy('date');
    }

    private function dateDesc(): Builder
    {
        return $this->builder->orderByDesc('date');
    }

    private function roomAsc(): Builder
    {
        return $this->builder->orderBy('room_id');
    }

    private function roomDesc(): Builder
    {
        return $this->builder->orderByDesc('room_id');
    }

    private function teacherAsc(): Builder
    {
        return $this->builder
            ->join('teachers', 'teachers.id', '=', 'lessons.teacher_id')
            ->orderBy('teachers.full_name');
    }

    private function teacherDesc(): Builder
    {
        return $this->builder
            ->join('teachers', 'teachers.id', '=', 'lessons.teacher_id')
            ->orderByDesc('teachers.full_name');
    }

    private function creatorAsc(): Builder
    {
        return $this->builder
            ->join('users', 'users.id', '=', 'lessons.created_by')
            ->orderBy('users.name');
    }

    private function creatorDesc(): Builder
    {
        return $this->builder
            ->join('users', 'users.id', '=', 'lessons.created_by')
            ->orderByDesc('users.name');
    }
}
