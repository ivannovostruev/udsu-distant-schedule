<?php

namespace App\Support\Pages;

class ReasonPage extends BasePage
{
    const DESTROY_REQUIRED          = false;

    const INDEX_PAGE_ID             = 'reasons';
    const SHOW_PAGE_ID              = 'reason';
    const CREATE_PAGE_ID            = 'create-reason';
    const EDIT_PAGE_ID              = 'edit-reason';

    const INDEX_PAGE_TITLE          = 'Причины';
    const SHOW_PAGE_TITLE           = 'Причина';
    const CREATE_PAGE_TITLE         = 'Новая причина';
    const EDIT_PAGE_TITLE           = 'Редактировать причину';

    const SHOW_PAGE_HEADER_VIEW     = 'dashboard.reasons.includes.show_page_header';
    const SHOW_PAGE_MAIN_VIEW       = 'dashboard.reasons.includes.show_page_main';

    const CREATE_FORM_VIEW          = 'dashboard.reasons.includes.create_form';
    const EDIT_FORM_VIEW            = 'dashboard.reasons.includes.edit_form';
    const INDEX_TABLE_VIEW          = 'dashboard.reasons.includes.table';
}
