<?php

namespace App\Models\Schedule;

class ReasonType
{
    const APPROVED = 1;
    const REJECTED = 2;

    const TYPES = [
        self::APPROVED,
        self::REJECTED,
    ];

    const TYPES_WITH_NAME = [
        self::APPROVED => 'утверждающая',
        self::REJECTED => 'отклоняющая',
    ];
}
