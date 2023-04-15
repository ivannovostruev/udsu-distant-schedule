<?php

namespace App\Support\ModelManagers;

use App\Support\Abilities\Abilities;
use App\Support\Pages\Page;
use App\Support\RouteNames\RouteNames;
use App\Support\ViewNames\ViewNames;

abstract class ModelManager
{
    protected Abilities $abilities;
    protected RouteNames $routeNames;
    protected ViewNames $viewNames;
    protected Page $page;

    /**
     * @param Abilities $abilities
     * @param RouteNames $routeNames
     * @param ViewNames $viewNames
     * @param Page $page
     */
    public function __construct(
        Abilities $abilities,
        RouteNames $routeNames,
        ViewNames $viewNames,
        Page $page
    ) {
        $this->abilities = $abilities;
        $this->routeNames = $routeNames;
        $this->viewNames = $viewNames;
        $this->page = $page;
    }

    /**
     * @return Abilities
     */
    public function getAbilities(): Abilities
    {
        return $this->abilities;
    }

    /**
     * @return RouteNames
     */
    public function getRouteNames(): RouteNames
    {
        return $this->routeNames;
    }

    /**
     * @return ViewNames
     */
    public function getViewNames(): ViewNames
    {
        return $this->viewNames;
    }

    /**
     * @return Page
     */
    public function getPage(): Page
    {
        return $this->page;
    }
}
