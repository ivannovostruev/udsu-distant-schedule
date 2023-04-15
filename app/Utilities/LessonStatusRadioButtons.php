<?php

namespace App\Utilities;

use App\Models\Schedule\LessonStatus;

class LessonStatusRadioButtons
{
    const BUTTONS_DATA = [
        [
            'code'              => LessonStatus::DRAFT,
            'name'              => 'Черновик',
            'shortname'         => 'ЧЕРН',
            'class'             => 'btn-outline-secondary',
        ],
        [
            'code'              => LessonStatus::REQUESTED,
            'name'              => 'Запрошено',
            'shortname'         => 'ЗАПР',
            'class'             => 'btn-outline-danger',
        ],
        [
            'code'              => LessonStatus::APPROVED,
            'name'              => 'Утверждено',
            'shortname'         => 'УТВ',
            'class'             => 'btn-outline-success',
        ],
        [
            'code'              => LessonStatus::REJECTED,
            'name'              => 'Отклонено',
            'shortname'         => 'ОТКЛ',
            'class'             => 'btn-outline-warning',
        ],
        [
            'code'              => LessonStatus::CANCELED,
            'name'              => 'Отменено',
            'shortname'         => 'ОТМЕН',
            'class'             => 'btn-outline-info',
        ],
    ];

    /**
     * @return LessonStatusRadioButton[]
     */
    public function get(): array
    {
        $buttons = [];
        foreach (self::BUTTONS_DATA as $buttonData) {
            $buttons[] = new LessonStatusRadioButton($buttonData);
        }
        return $buttons;
    }
}
