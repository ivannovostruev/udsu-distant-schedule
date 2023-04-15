<?php

namespace App\Support\Pages;

class UserPage extends BasePage
{
    const SEARCH_REQUIRED           = true;
    const FILTERS_REQUIRED          = true;
    const PER_PAGE_REQUIRED         = true;

    const INDEX_PAGE_ID             = 'users';
    const SHOW_PAGE_ID              = 'user';
    const CREATE_PAGE_ID            = 'create-user';
    const EDIT_PAGE_ID              = 'edit-user';

    const INDEX_PAGE_TITLE          = 'Пользователи';
    const SHOW_PAGE_TITLE           = 'Пользователь';
    const CREATE_PAGE_TITLE         = 'Новый пользователь';
    const EDIT_PAGE_TITLE           = 'Редактировать пользователя';

    const SHOW_PAGE_HEADER_VIEW     = 'dashboard.users.includes.show_page_header';
    const SHOW_PAGE_MAIN_VIEW       = 'dashboard.users.includes.show_page_main';

    const CREATE_FORM_VIEW          = 'dashboard.users.includes.create_form';
    const EDIT_FORM_VIEW            = 'dashboard.users.includes.edit_form';
    const INDEX_TABLE_VIEW          = 'dashboard.users.includes.table';

    const SEARCH_FORM_VIEW          = 'dashboard.users.includes.search_form';
    const FILTERS_VIEW              = 'dashboard.users.filters';
}
