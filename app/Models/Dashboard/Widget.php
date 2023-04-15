<?php

namespace App\Models\Dashboard;

class Widget
{
    private string $title;
    private int $count;
    private string $route;
    private string $cssClass;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setTitle($data);
        $this->setCount($data);
        $this->setRoute($data);
        $this->setCssClass($data);
    }

    /**
     * @param array $data
     */
    public function setTitle(array $data): void
    {
        $this->title = $data['title'];
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param array $data
     */
    public function setCount(array $data): void
    {
        $model = $data['model'];
        $this->count = (new $model)->count();
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @param array $data
     */
    public function setRoute(array $data): void
    {
        $this->route = $data['route'];
    }

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return $this->route;
    }

    /**
     * @param array $data
     */
    public function setCssClass(array $data): void
    {
        $this->cssClass = $data['class'];
    }

    /**
     * @return string
     */
    public function getCssClass(): string
    {
        return $this->cssClass;
    }
}
