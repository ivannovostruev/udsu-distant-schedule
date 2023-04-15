<?php

namespace App\Utilities;

use App\Models\Schedule\Lesson;
use App\Models\Schedule\LessonStatus;
use App\Models\User;
use ErrorException;

class LessonStatusResolver
{
    const ACTION_DRAFT = 'save_as_draft';

    /**
     * @param array $data
     * @param User $user
     * @return int
     * @throws ErrorException
     */
    public static function resolve(array $data, User $user): int
    {
        $messageFormat = 'Статус не существует. Переданный код: %s';

        $action = $data['action'] ?? '';
        $status = $data['status'] ?? '';

        if ($action === self::ACTION_DRAFT) {
            return LessonStatus::DRAFT;
        } else if ($user->isCreator()) {
            return LessonStatus::REQUESTED;
        } else if (!empty($status) && Lesson::statusExists($status)) {
            return (int) $status;
        } else {
            throw new ErrorException(sprintf($messageFormat, $status));
        }
    }
}
