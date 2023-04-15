<?php

namespace App\Support\Pages;

class LessonPage extends BasePage
{
    const SEARCH_REQUIRED           = true;
    const FILTERS_REQUIRED          = true;
    const PER_PAGE_REQUIRED         = true;

    const INDEX_PAGE_ID             = 'lessons';
    const SHOW_PAGE_ID              = 'lesson';
    const CREATE_PAGE_ID            = 'create-lesson';
    const EDIT_PAGE_ID              = 'edit-lesson';

    const INDEX_PAGE_TITLE          = 'Занятия';
    const SHOW_PAGE_TITLE           = 'Занятие';
    const CREATE_PAGE_TITLE         = 'Новое занятие';
    const EDIT_PAGE_TITLE           = 'Редактировать занятие';

    const SHOW_PAGE_HEADER_VIEW     = 'dashboard.lessons.includes.show_page_header';
    const SHOW_PAGE_MAIN_VIEW       = 'dashboard.lessons.includes.show_page_main';

    const CREATE_FORM_VIEW          = 'dashboard.lessons.includes.create_form';
    const EDIT_FORM_VIEW            = 'dashboard.lessons.includes.edit_form';
    const INDEX_TABLE_VIEW          = 'dashboard.lessons.includes.table';

    const SEARCH_FORM_VIEW          = 'dashboard.lessons.includes.search_form';
    const FILTERS_VIEW              = 'dashboard.lessons.filters';

    const FAST_CREATE_PAGE_MAIN_VIEW    = 'dashboard.lessons.includes.fast_create_page_main';
    const FAST_CREATE_FORM_VIEW         = 'dashboard.lessons.includes.fast_create_form';

    /**
     * @return string
     */
    public function getFastCreatePageMainView(): string
    {
        return static::FAST_CREATE_PAGE_MAIN_VIEW;
    }

    /**
     * @return string
     */
    public function getFastCreateFormView(): string
    {
        return static::FAST_CREATE_FORM_VIEW;
    }
}
