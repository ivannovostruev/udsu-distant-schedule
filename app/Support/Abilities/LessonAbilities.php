<?php

namespace App\Support\Abilities;

class LessonAbilities extends Abilities
{
    const INDEX     = 'lesson-index';
    const CREATE    = 'lesson-create';
    const STORE     = 'lesson-store';
    const SHOW      = 'lesson-show';
    const EDIT      = 'lesson-edit';
    const UPDATE    = 'lesson-update';
    const DESTROY   = 'lesson-destroy';

    const APPROVE           = 'lesson-approve';
    const SHOW_ADMIN_OPTION = 'lesson-show-admin-option';

    public function approve(): string
    {
        return static::APPROVE;
    }

    public function showAdminOption(): string
    {
        return static::SHOW_ADMIN_OPTION;
    }
}
