<?php

namespace App\Models\Schedule;

class LessonLinkType
{
    const TYPICAL    = 1;
    const INDIVIDUAL = 2;

    const LINK_TYPES = [
        self::TYPICAL,
        self::INDIVIDUAL,
    ];

    const LINK_TYPES_WITH_NAME = [
        self::TYPICAL    => 'типовая',
        self::INDIVIDUAL => 'индивидуальная',
    ];

    /**
     * @param int $linkType
     * @return bool
     */
    public static function exists(int $linkType): bool
    {
        return in_array($linkType, self::LINK_TYPES);
    }
}
