<?php

namespace App\Models\Dashboard;

use App\Support\Abilities\ColorAbilities;
use App\Support\Abilities\DashboardAbilities;
use App\Support\Abilities\GroupAbilities;
use App\Support\Abilities\LessonAbilities;
use App\Support\Abilities\ReasonAbilities;
use App\Support\Abilities\RoomAbilities;
use App\Support\Abilities\TimeslotAbilities;
use App\Support\Abilities\UserAbilities;

class Sidebar
{
    const LINKS_DATA = [
        [
            'ability'   => DashboardAbilities::INDEX,
            'route'     => 'dashboard',
            'title'     => 'Панель управления',
            'class'     => 'bi bi-speedometer2',
        ],
        [
            'ability'   => LessonAbilities::INDEX,
            'route'     => 'dashboard.lessons.index',
            'title'     => 'Занятия',
            'class'     => 'bi bi-person-workspace',
        ],
        [
            'ability'   => TimeslotAbilities::INDEX,
            'route'     => 'dashboard.teachers.index',
            'title'     => 'Преподаватели',
            'class'     => 'bi bi-star',
        ],
        [
            'ability'   => RoomAbilities::INDEX,
            'route'     => 'dashboard.rooms.index',
            'title'     => 'Комнаты',
            'class'     => 'bi bi-box',
        ],
        [
            'ability'   => TimeslotAbilities::INDEX,
            'route'     => 'dashboard.timeslots.index',
            'title'     => 'Таймслоты',
            'class'     => 'bi bi-alarm',
        ],
        [
            'ability'   => GroupAbilities::INDEX,
            'route'     => 'dashboard.groups.index',
            'title'     => 'Академические группы',
            'class'     => 'bi bi-mortarboard',
        ],
        [
            'ability'   => ColorAbilities::INDEX,
            'route'     => 'dashboard.colors.index',
            'title'     => 'Цвета ячеек',
            'class'     => 'bi bi-palette',
        ],
        [
            'ability'   => ReasonAbilities::INDEX,
            'route'     => 'dashboard.reasons.index',
            'title'     => 'Причины',
            'class'     => 'bi bi-exclamation-octagon',
        ],
        [
            'ability'   => UserAbilities::INDEX,
            'route'     => 'dashboard.users.index',
            'title'     => 'Пользователи',
            'class'     => 'bi bi-people',
        ],
    ];

    /**
     * @return SidebarLink[]
     */
    public function links(): array
    {
        $links = [];
        foreach (self::LINKS_DATA as $linkData) {
            $links[] = new SidebarLink($linkData);
        }
        return $links;
    }
}
