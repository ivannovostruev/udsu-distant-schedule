<?php

namespace App\Models\Schedule;

class LessonStatus
{
    const DRAFT     = 1;
    const REQUESTED = 2;
    const APPROVED  = 3;
    const REJECTED  = 4;
    const CANCELED  = 5;

    const STATUSES = [
        self::DRAFT,
        self::REQUESTED,
        self::APPROVED,
        self::REJECTED,
        self::CANCELED,
    ];

    const STATUSES_WITH_NAME = [
        self::DRAFT     => 'черновик',
        self::REQUESTED => 'запрошено',
        self::APPROVED  => 'утверждено',
        self::REJECTED  => 'отклонено',
        self::CANCELED  => 'отменено',
    ];

    /**
     * @param int $statusCode
     * @return bool
     */
    public static function exists(int $statusCode): bool
    {
        return in_array($statusCode, self::STATUSES, true);
    }

    /**
     * @param int $status
     * @return string
     */
    public static function getCssClass(int $status): string
    {
        return match ($status) {
            self::DRAFT     => 'bg-status-draft',
            self::REQUESTED => 'bg-status-requested',
            self::APPROVED  => 'bg-status-approved',
            self::REJECTED  => 'bg-status-rejected',
            self::CANCELED  => 'bg-status-canceled',
            default => '',
        };
    }
}
