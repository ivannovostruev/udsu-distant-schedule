<?php

namespace App\Support\Pages;

class ColorPage extends BasePage
{
    const INDEX_PAGE_ID             = 'colors';
    const SHOW_PAGE_ID              = 'color';
    const CREATE_PAGE_ID            = 'create-color';
    const EDIT_PAGE_ID              = 'edit-color';

    const INDEX_PAGE_TITLE          = 'Цвета ячеек';
    const SHOW_PAGE_TITLE           = 'Цвет ячейки';
    const CREATE_PAGE_TITLE         = 'Новый цвет ячейки';
    const EDIT_PAGE_TITLE           = 'Редактировать цвет ячейки';

    const SHOW_PAGE_HEADER_VIEW     = 'dashboard.colors.includes.show_page_header';
    const SHOW_PAGE_MAIN_VIEW       = 'dashboard.colors.includes.show_page_main';

    const CREATE_FORM_VIEW          = 'dashboard.colors.includes.create_form';
    const EDIT_FORM_VIEW            = 'dashboard.colors.includes.edit_form';
    const INDEX_TABLE_VIEW          = 'dashboard.colors.includes.table';
}
