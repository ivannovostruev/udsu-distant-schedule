<?php

namespace App\Models\Dashboard;

use App\Models\Schedule\Color;
use App\Models\Schedule\Group;
use App\Models\Schedule\Lesson;
use App\Models\Schedule\Room;
use App\Models\Schedule\Teacher;
use App\Models\Schedule\Timeslot;
use App\Models\User;

class Dashboard
{
    const WIDGETS_DATA = [
        [
            'title' => 'Занятия',
            'model' => Lesson::class,
            'route' => 'dashboard.lessons.index',
            'class' => 'widget-lessons',
        ],
        [
            'title' => 'Комнаты',
            'model' => Room::class,
            'route' => 'dashboard.rooms.index',
            'class' => 'widget-rooms',
        ],
        [
            'title' => 'Преподаватели',
            'model' => Teacher::class,
            'route' => 'dashboard.teachers.index',
            'class' => 'widget-teachers',
        ],
        [
            'title' => 'Академические группы',
            'model' => Group::class,
            'route' => 'dashboard.groups.index',
            'class' => 'widget-groups',
        ],
        [
            'title' => 'Цвета ячеек',
            'model' => Color::class,
            'route' => 'dashboard.colors.index',
            'class' => 'widget-colors',
        ],
        [
            'title' => 'Таймслоты',
            'model' => Timeslot::class,
            'route' => 'dashboard.timeslots.index',
            'class' => 'widget-timeslots',
        ],
        [
            'title' => 'Пользователи',
            'model' => User::class,
            'route' => 'dashboard.users.index',
            'class' => 'widget-users',
        ],
    ];

    /**
     * @return Widget[]
     */
    public function widgets(): array
    {
        $widgets = [];
        foreach (self::WIDGETS_DATA as $widgetData) {
            $widgets[] = new Widget($widgetData);
        }
        return $widgets;
    }

    /**
     * @return Sidebar
     */
    public function sidebar(): Sidebar
    {
        return new Sidebar();
    }
}
