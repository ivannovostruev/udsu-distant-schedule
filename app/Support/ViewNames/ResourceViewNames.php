<?php

namespace App\Support\ViewNames;

class ResourceViewNames extends ViewNames
{
    const INDEX     = 'dashboard.index';
    const CREATE    = 'dashboard.create';
    const SHOW      = 'dashboard.show';
    const EDIT      = 'dashboard.edit';
    const UPLOAD    = 'dashboard.upload';

    public function index(): string
    {
        return static::INDEX;
    }

    public function create(): string
    {
        return static::CREATE;
    }

    public function show(): string
    {
        return static::SHOW;
    }

    public function edit(): string
    {
        return static::EDIT;
    }

    public function upload(): string
    {
        return static::UPLOAD;
    }
}
