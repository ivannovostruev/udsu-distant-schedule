<?php

namespace App\Models\Schedule;

class LessonType
{
    const NO         = 1;
    const LECTURE    = 2;
    const PRACTICE   = 3;
    const EXAM       = 4;
    const OFFSET     = 5;
    const SEMINAR    = 6;
    const MEETING    = 7;
    const WEBINAR    = 8;
    const CONFERENCE = 9;

    const TYPES = [
        self::NO,
        self::LECTURE,
        self::PRACTICE,
        self::EXAM,
        self::OFFSET,
        self::SEMINAR,
        self::MEETING,
        self::WEBINAR,
        self::CONFERENCE,
    ];

    const TYPES_WITH_NAME = [
        self::NO          => 'без типа',
        self::LECTURE     => 'лекция',
        self::PRACTICE    => 'практика',
        self::EXAM        => 'экзамен',
        self::OFFSET      => 'зачет',
        self::SEMINAR     => 'семинар',
        self::MEETING     => 'совещание',
        self::WEBINAR     => 'вебинар',
        self::CONFERENCE  => 'конференция',
    ];
}
