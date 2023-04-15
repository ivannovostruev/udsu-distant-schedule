<?php

namespace App\Support\Pages;

class BasePage extends Page
{
    const SEARCH_REQUIRED           = false;
    const FILTERS_REQUIRED          = false;
    const PER_PAGE_REQUIRED         = false;
    const UPLOAD_REQUIRED           = false;
    const DESTROY_REQUIRED          = true;

    const INDEX_PAGE_ID             = '';
    const SHOW_PAGE_ID              = '';
    const CREATE_PAGE_ID            = '';
    const EDIT_PAGE_ID              = '';

    const INDEX_PAGE_TITLE          = '';
    const SHOW_PAGE_TITLE           = '';
    const CREATE_PAGE_TITLE         = '';
    const EDIT_PAGE_TITLE           = '';

    const INDEX_PAGE_HEADER_VIEW    = 'dashboard.includes.index_page_header';
    const INDEX_PAGE_MAIN_VIEW      = 'dashboard.includes.index_page_main';
    const SHOW_PAGE_HEADER_VIEW     = 'dashboard.includes.show_page_header';
    const SHOW_PAGE_MAIN_VIEW       = 'dashboard.includes.show_page_main';
    const CREATE_PAGE_HEADER_VIEW   = 'dashboard.includes.create_page_header';
    const CREATE_PAGE_MAIN_VIEW     = 'dashboard.includes.create_page_main';
    const EDIT_PAGE_HEADER_VIEW     = 'dashboard.includes.edit_page_header';
    const EDIT_PAGE_MAIN_VIEW       = 'dashboard.includes.edit_page_main';

    const CREATE_FORM_VIEW          = '';
    const EDIT_FORM_VIEW            = '';
    const INDEX_TABLE_VIEW          = '';

    const SEARCH_FORM_VIEW          = '';
    const FILTERS_VIEW              = '';


    public function getIndexPageId(): string
    {
        return static::INDEX_PAGE_ID;
    }

    public function getShowPageId(): string
    {
        return static::SHOW_PAGE_ID;
    }

    public function getCreatePageId(): string
    {
        return static::CREATE_PAGE_ID;
    }

    public function getEditPageId(): string
    {
        return static::EDIT_PAGE_ID;
    }

    public function getIndexPageTitle(): string
    {
        return static::INDEX_PAGE_TITLE;
    }

    public function getShowPageTitle(): string
    {
        return static::SHOW_PAGE_TITLE;
    }

    public function getCreatePageTitle(): string
    {
        return static::CREATE_PAGE_TITLE;
    }

    public function getEditPageTitle(): string
    {
        return static::EDIT_PAGE_TITLE;
    }

    public function getIndexPageHeaderView(): string
    {
        return static::INDEX_PAGE_HEADER_VIEW;
    }

    public function getIndexPageMainView(): string
    {
        return static::INDEX_PAGE_MAIN_VIEW;
    }

    public function getShowPageHeaderView(): string
    {
        return static::SHOW_PAGE_HEADER_VIEW;
    }

    public function getShowPageMainView(): string
    {
        return static::SHOW_PAGE_MAIN_VIEW;
    }

    public function getCreatePageHeaderView(): string
    {
        return static::CREATE_PAGE_HEADER_VIEW;
    }

    public function getCreatePageMainView(): string
    {
        return static::CREATE_PAGE_MAIN_VIEW;
    }

    public function getEditPageHeaderView(): string
    {
        return static::EDIT_PAGE_HEADER_VIEW;
    }

    public function getEditPageMainView(): string
    {
        return static::EDIT_PAGE_MAIN_VIEW;
    }

    public function getCreateFormView(): string
    {
        return static::CREATE_FORM_VIEW;
    }

    public function getEditFormView(): string
    {
        return static::EDIT_FORM_VIEW;
    }

    public function getIndexTableView(): string
    {
        return static::INDEX_TABLE_VIEW;
    }


    public function isSearchRequired(): bool
    {
        return static::SEARCH_REQUIRED;
    }

    public function isPerPageRequired(): bool
    {
        return static::PER_PAGE_REQUIRED;
    }

    public function isFiltersRequired(): bool
    {
        return static::FILTERS_REQUIRED;
    }

    public function isUploadRequired(): bool
    {
        return static::UPLOAD_REQUIRED;
    }

    public function isDestroyRequired(): bool
    {
        return static::DESTROY_REQUIRED;
    }


    public function getSearchFormView(): string
    {
        return static::SEARCH_FORM_VIEW;
    }

    public function getFiltersView(): string
    {
        return static::FILTERS_VIEW;
    }
}
