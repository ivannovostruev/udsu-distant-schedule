<?php

namespace App\Models\Schedule;

class LessonEducationLevel
{
    const BACHELOR              = 1;
    const SPECIALIST            = 2;
    const MASTER                = 3;
    const POSTGRADUATE          = 4;
    const SPECIALIZED_SECONDARY = 5;
    const ADDITIONAL            = 6;
    const OTHER                 = 7;

    const EDUCATION_LEVELS = [
        self::BACHELOR,
        self::SPECIALIST,
        self::MASTER,
        self::POSTGRADUATE,
        self::SPECIALIZED_SECONDARY,
        self::ADDITIONAL,
        self::OTHER,
    ];

    const EDUCATION_LEVELS_WITH_NAME = [
        self::BACHELOR                 => 'бакалавриат',
        self::SPECIALIST               => 'специалитет',
        self::MASTER                   => 'магистратура',
        self::POSTGRADUATE             => 'аспирантура',
        self::SPECIALIZED_SECONDARY    => 'СПО',
        self::ADDITIONAL               => 'ДПО',
        self::OTHER                    => 'другое',
    ];
}
