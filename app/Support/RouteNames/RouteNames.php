<?php

namespace App\Support\RouteNames;

use Exception;

/**
 * Класс для хранения названий маршрутов
 * Объект данного класса используется в видах
 * и служит для предотвращения от хардкода
 */
class RouteNames
{
    /**
     * @throws Exception
     */
    public function __get(string $name): string
    {
        if (!method_exists($this, $name)) {
            throw new Exception('Method ' . $name . ' does not exist in class '. static::class);
        }
        return $this->{$name}();
    }
}
