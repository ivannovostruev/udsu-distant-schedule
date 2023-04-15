<?php

namespace App\Support\Pages;

class RoomsPage extends BasePage
{
    const INDEX_PAGE_ID             = 'rooms';
    const SHOW_PAGE_ID              = 'room';
    const CREATE_PAGE_ID            = 'create-room';
    const EDIT_PAGE_ID              = 'edit-room';

    const INDEX_PAGE_TITLE          = 'Комнаты';
    const SHOW_PAGE_TITLE           = 'Комната';
    const CREATE_PAGE_TITLE         = 'Новая комната';
    const EDIT_PAGE_TITLE           = 'Редактировать комнату';

    const SHOW_PAGE_HEADER_VIEW     = 'dashboard.rooms.includes.show_page_header';
    const SHOW_PAGE_MAIN_VIEW       = 'dashboard.rooms.includes.show_page_main';

    const CREATE_FORM_VIEW          = 'dashboard.rooms.includes.create_form';
    const EDIT_FORM_VIEW            = 'dashboard.rooms.includes.edit_form';
    const INDEX_TABLE_VIEW          = 'dashboard.rooms.includes.table';
}
