<?php

namespace App\Support\Pages;

abstract class Page
{
    abstract public function getIndexPageId(): string;
    abstract public function getShowPageId(): string;
    abstract public function getCreatePageId(): string;
    abstract public function getEditPageId(): string;

    abstract public function getIndexPageTitle(): string;
    abstract public function getShowPageTitle(): string;
    abstract public function getCreatePageTitle(): string;
    abstract public function getEditPageTitle(): string;

    abstract public function getIndexPageHeaderView(): string;
    abstract public function getIndexPageMainView(): string;
    abstract public function getShowPageHeaderView(): string;
    abstract public function getShowPageMainView(): string;
    abstract public function getCreatePageHeaderView(): string;
    abstract public function getCreatePageMainView(): string;
    abstract public function getEditPageHeaderView(): string;
    abstract public function getEditPageMainView(): string;

    abstract public function getCreateFormView(): string;
    abstract public function getEditFormView(): string;
    abstract public function getIndexTableView(): string;

    abstract public function isSearchRequired(): bool;
    abstract public function isPerPageRequired(): bool;
    abstract public function isFiltersRequired(): bool;
    abstract public function isUploadRequired(): bool;
    abstract public function isDestroyRequired(): bool;

    abstract public function getSearchFormView(): string;
    abstract public function getFiltersView(): string;
}
