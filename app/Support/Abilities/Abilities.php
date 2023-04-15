<?php

namespace App\Support\Abilities;

class Abilities
{
    const INDEX     = '';
    const CREATE    = '';
    const STORE     = '';
    const SHOW      = '';
    const EDIT      = '';
    const UPDATE    = '';
    const DESTROY   = '';
    const IMPORT    = '';

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

    public function destroy(): string
    {
        return static::DESTROY;
    }

    public function store(): string
    {
        return static::STORE;
    }

    public function update(): string
    {
        return static::UPDATE;
    }

    public function import(): string
    {
        return static::IMPORT;
    }
}
