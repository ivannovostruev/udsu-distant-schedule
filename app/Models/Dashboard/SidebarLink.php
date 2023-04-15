<?php

namespace App\Models\Dashboard;

class SidebarLink
{
    private string $ability;
    private string $route;
    private string $title;
    private string $iconClass;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setAbility($data);
        $this->setRoute($data);
        $this->setTitle($data);
        $this->setIconClass($data);
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return route($this->getRoute()) === request()->url();
    }

    /**
     * @param array $data
     */
    public function setAbility(array $data): void
    {
        $this->ability = $data['ability'];
    }

    /**
     * @return string
     */
    public function getAbility(): string
    {
        return $this->ability;
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
    public function setIconClass(array $data): void
    {
        $this->iconClass = $data['class'];
    }

    /**
     * @return string
     */
    public function getIconClass(): string
    {
        return $this->iconClass;
    }
}
