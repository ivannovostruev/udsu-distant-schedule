<?php

namespace App\Models\Schedule;

class LessonPeriodicity
{
    const ONCE      = 1;
    const WEEKLY    = 2;
    const EVEN      = 3; // четная
    const ODD       = 4; // нечетная
    const EVERYDAY  = 5;

    const PERIODICITY = [
        self::ONCE,
        self::WEEKLY,
        self::EVEN,
        self::ODD,
        self::EVERYDAY,
    ];

    const PERIODICITY_WITH_NAME = [
        self::ONCE      => 'однократно',
        self::WEEKLY    => 'еженедельно',
        self::EVEN      => 'над чертой',
        self::ODD       => 'под чертой',
        self::EVERYDAY  => 'ежедневно',
    ];

    /**
     * @param int $periodicity
     * @return bool
     */
    public static function exists(int $periodicity): bool
    {
        return in_array($periodicity, self::PERIODICITY);
    }
}
