<?php

namespace App\Support\Pages;

class TeacherPage extends BasePage
{
    const SEARCH_REQUIRED           = true;
    const FILTERS_REQUIRED          = true;
    const PER_PAGE_REQUIRED         = true;
    const UPLOAD_REQUIRED           = true;

    const INDEX_PAGE_ID             = 'teachers';
    const SHOW_PAGE_ID              = 'teacher';
    const CREATE_PAGE_ID            = 'create-teacher';
    const EDIT_PAGE_ID              = 'edit-teacher';

    const INDEX_PAGE_TITLE          = 'Преподаватели';
    const SHOW_PAGE_TITLE           = 'Преподаватель';
    const CREATE_PAGE_TITLE         = 'Новый преподаватель';
    const EDIT_PAGE_TITLE           = 'Редактировать преподавателя';

    const SHOW_PAGE_HEADER_VIEW     = 'dashboard.teachers.includes.show_page_header';
    const SHOW_PAGE_MAIN_VIEW       = 'dashboard.teachers.includes.show_page_main';

    const CREATE_FORM_VIEW          = 'dashboard.teachers.includes.create_form';
    const EDIT_FORM_VIEW            = 'dashboard.teachers.includes.edit_form';
    const INDEX_TABLE_VIEW          = 'dashboard.teachers.includes.table';

    const SEARCH_FORM_VIEW          = 'dashboard.teachers.includes.search_form';
    const FILTERS_VIEW              = 'dashboard.teachers.filters';
}
