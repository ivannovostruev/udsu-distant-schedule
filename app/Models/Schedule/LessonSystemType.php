<?php

namespace App\Models\Schedule;

class LessonSystemType
{
    const MIRAPOLIS = 1;
    const ZOOM      = 2;
    const OTHER     = 3;

    const SYSTEM_TYPES = [
        self::MIRAPOLIS,
        self::ZOOM,
        self::OTHER,
    ];

    const SYSTEM_TYPES_WITH_NAMES = [
        self::MIRAPOLIS  => 'Mirapolis',
        self::ZOOM       => 'Zoom',
        self::OTHER      => 'Другая',
    ];
}
