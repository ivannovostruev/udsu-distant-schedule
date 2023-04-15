<?php

namespace App\Models\Schedule;

class LessonSpecialRequirement
{
    const BOARD            = 1;
    const TABLET           = 2;
    const DOCUMENT_CAMERA  = 3;

    const SPECIAL_REQUIREMENTS = [
        self::BOARD,
        self::TABLET,
        self::DOCUMENT_CAMERA,
    ];

    const SPECIAL_REQUIREMENTS_WITH_NAME = [
        self::BOARD            => 'доска',
        self::TABLET           => 'планшет',
        self::DOCUMENT_CAMERA  => 'документ-камера',
    ];
}
