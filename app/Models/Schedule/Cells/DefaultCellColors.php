<?php

namespace App\Models\Schedule\Cells;

use App\Models\Schedule\Lesson;
use App\Models\Schedule\LessonEducationLevel;

class DefaultCellColors
{
    private const COLOR_1_HEX = '#d9ead3';
    private const COLOR_2_HEX = '#666';

    private const COLOR_1_DESCRIPTION = 'Цвет для УМУ (бакалавры, специалисты, магистры)';
    private const COLOR_2_DESCRIPTION = 'Отменённые';

    private const COLORS_DESCRIPTION = [
        self::COLOR_1_HEX => self::COLOR_1_DESCRIPTION,
        self::COLOR_2_HEX => self::COLOR_2_DESCRIPTION,
    ];

    /**
     * @param Lesson $lesson
     * @return string|null
     */
    public static function determine(Lesson $lesson): ?string
    {
        if ($lesson->isCanceled()) {
            return self::COLOR_2_HEX;
        } elseif (self::educationLevelBelongsToUmu($lesson->education_level)) {
            return self::COLOR_1_HEX;
        } else {
            return null;
        }
    }

    /**
     * @return string[]
     */
    public static function getWithDescription(): array
    {
        return self::COLORS_DESCRIPTION;
    }

    /**
     * @param int $educationLevel
     * @return bool
     */
    private static function educationLevelBelongsToUmu(int $educationLevel): bool
    {
        $condition = [
            LessonEducationLevel::BACHELOR,
            LessonEducationLevel::SPECIALIST,
            LessonEducationLevel::MASTER,
        ];
        return in_array($educationLevel, $condition);
    }
}
