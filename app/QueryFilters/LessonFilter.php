<?php

namespace App\QueryFilters;

use Illuminate\Database\Eloquent\Builder;

class LessonFilter extends QueryFilter
{
    public function name(string $name): void
    {
        $words = array_filter(explode(' ', $name));

        $this->builder->where(function (Builder $query) use ($words) {
            foreach ($words as $word) {
                $query->where('name', 'like', "%$word%");
            }
        });
    }

    public function status(string $status): void
    {
        $this->builder->where('status', strtolower($status));
    }

    public function roomId(string $roomId): void
    {
        $this->builder->where('room_id', strtolower($roomId));
    }

    public function location(string $location): void
    {
        $this->builder->where('location', strtolower($location));
    }

    public function type(string $type): void
    {
        $this->builder->where('type', strtolower($type));
    }

    public function date(string $date): void
    {
        $this->builder->where('date', strtolower($date));
    }

    public function systemType(string $systemType): void
    {
        $this->builder->where('system_type', strtolower($systemType));
    }

    public function linkType(string $linkType): void
    {
        $this->builder->where('link_type', strtolower($linkType));
    }

    public function specialRequirements(string $specialRequirements): void
    {
        $this->builder->where('special_requirements', strtolower($specialRequirements));
    }

    public function shouldRecord(string $shouldRecord): void
    {
        $this->builder->where('should_record', strtolower($shouldRecord));
    }

    public function teacherId(string $teacherId): void
    {
        $this->builder->where('teacher_id', strtolower($teacherId));
    }

    public function createdBy(string $createdBy): void
    {
        $this->builder->where('created_by', strtolower($createdBy));
    }

    public function colorId(string $colorId): void
    {
        $this->builder->where('color_id', strtolower($colorId));
    }

    public function educationLevel(string $educationLevel): void
    {
        $this->builder->where('education_level', strtolower($educationLevel));
    }

    //public function timeslots(string $timeslots): void {}
    //public function groups(string $groups): void {}
}
