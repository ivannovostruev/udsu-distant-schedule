<?php

namespace App\Support\Pages;

class GroupPage extends BasePage
{
    const SEARCH_REQUIRED           = true;
    const PER_PAGE_REQUIRED         = true;
    const UPLOAD_REQUIRED           = true;

    const INDEX_PAGE_ID             = 'groups';
    const SHOW_PAGE_ID              = 'group';
    const CREATE_PAGE_ID            = 'create-group';
    const EDIT_PAGE_ID              = 'edit-group';

    const INDEX_PAGE_TITLE          = 'Академические группы';
    const SHOW_PAGE_TITLE           = 'Академическая группа';
    const CREATE_PAGE_TITLE         = 'Новая академическая группа';
    const EDIT_PAGE_TITLE           = 'Редактировать академическую группу';

    const SHOW_PAGE_HEADER_VIEW     = 'dashboard.groups.includes.show_page_header';
    const SHOW_PAGE_MAIN_VIEW       = 'dashboard.groups.includes.show_page_main';

    const CREATE_FORM_VIEW          = 'dashboard.groups.includes.create_form';
    const EDIT_FORM_VIEW            = 'dashboard.groups.includes.edit_form';
    const INDEX_TABLE_VIEW          = 'dashboard.groups.includes.table';

    const SEARCH_FORM_VIEW          = 'dashboard.groups.includes.search_form';
}
