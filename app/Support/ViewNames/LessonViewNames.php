<?php

namespace App\Support\ViewNames;

class LessonViewNames extends ResourceViewNames
{
    const FAST_CREATE  = 'dashboard.lessons.fast_create';

    public function fastCreate(): string
    {
        return static::FAST_CREATE;
    }
}
