<?php

namespace App\Http\Controllers\Dashboard;

trait AbilitiesMethods
{
    public function getIndexAbility(): string
    {
        return $this->abilities->index();
    }

    public function getCreateAbility(): string
    {
        return $this->abilities->create();
    }

    public function getShowAbility(): string
    {
        return $this->abilities->show();
    }

    public function getEditAbility(): string
    {
        return $this->abilities->edit();
    }

    public function getDestroyAbility(): string
    {
        return $this->abilities->destroy();
    }

    public function getStoreAbility(): string
    {
        return $this->abilities->store();
    }

    public function getUpdateAbility(): string
    {
        return $this->abilities->update();
    }
}
