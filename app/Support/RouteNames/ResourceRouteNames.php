<?php

namespace App\Support\RouteNames;

/**
 * Класс для хранения названий маршрутов
 * Объект данного класса используется в видах
 * и служит для предотвращения от хардкода
 */
class ResourceRouteNames extends RouteNames
{
    const INDEX    = '';
    const CREATE   = '';
    const STORE    = '';
    const SHOW     = '';
    const EDIT     = '';
    const UPDATE   = '';
    const DESTROY  = '';

    const UPLOAD   = '';

    public function index(): string
    {
        return static::INDEX;
    }

    public function create(): string
    {
        return static::CREATE;
    }

    public function store(): string
    {
        return static::STORE;
    }

    public function show(): string
    {
        return static::SHOW;
    }

    public function edit(): string
    {
        return static::EDIT;
    }

    public function update(): string
    {
        return static::UPDATE;
    }

    public function destroy(): string
    {
        return static::DESTROY;
    }

    public function upload(): string
    {
        return static::UPLOAD;
    }
}
