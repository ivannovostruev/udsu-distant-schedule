<?php

namespace App\Http\Controllers\Dashboard;

trait ViewNamesMethods
{
    /**
     * @return string
     */
    protected function getIndexViewName(): string
    {
        return $this->viewNames->index();
    }

    /**
     * @return string
     */
    protected function getCreateViewName(): string
    {
        return $this->viewNames->create();
    }

    /**
     * @return string
     */
    protected function getShowViewName(): string
    {
        return $this->viewNames->show();
    }

    /**
     * @return string
     */
    protected function getEditViewName(): string
    {
        return $this->viewNames->edit();
    }

    /**
     * @return string
     */
    protected function getUploadViewName(): string
    {
        return $this->viewNames->upload();
    }
}
