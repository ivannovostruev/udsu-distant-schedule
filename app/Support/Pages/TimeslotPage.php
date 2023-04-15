<?php

namespace App\Support\Pages;

class TimeslotPage extends BasePage
{
    const DESTROY_REQUIRED          = false;

    const INDEX_PAGE_ID             = 'timeslots';
    const SHOW_PAGE_ID              = 'timeslot';
    const CREATE_PAGE_ID            = 'create-timeslot';
    const EDIT_PAGE_ID              = 'edit-timeslot';

    const INDEX_PAGE_TITLE          = 'Таймслоты';
    const SHOW_PAGE_TITLE           = 'Таймслот';
    const CREATE_PAGE_TITLE         = 'Новый таймслот';
    const EDIT_PAGE_TITLE           = 'Редактировать таймслот';

    const SHOW_PAGE_HEADER_VIEW     = 'dashboard.timeslots.includes.show_page_header';
    const SHOW_PAGE_MAIN_VIEW       = 'dashboard.timeslots.includes.show_page_main';

    const CREATE_FORM_VIEW          = 'dashboard.timeslots.includes.create_form';
    const EDIT_FORM_VIEW            = 'dashboard.timeslots.includes.edit_form';
    const INDEX_TABLE_VIEW          = 'dashboard.timeslots.includes.table';
}
