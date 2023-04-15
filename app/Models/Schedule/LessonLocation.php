<?php

namespace App\Models\Schedule;

class LessonLocation
{
    const CENTER        = 1;
    const HOME          = 2;
    const DEPARTMENT    = 3;
    const ANOTHER_PLACE = 4;

    const LOCATIONS = [
        self::CENTER,
        self::HOME,
        self::DEPARTMENT,
        self::ANOTHER_PLACE,
    ];

    const LOCATIONS_WITH_NAME = [
        self::CENTER          => 'ЦДТиЭСО',
        self::HOME            => 'из дома',
        self::DEPARTMENT      => 'из института/кафедры',
        self::ANOTHER_PLACE   => 'другое место',
    ];
}
