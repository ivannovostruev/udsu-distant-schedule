<?php

namespace App\Models\Schedule\Cells;

use App\Models\Schedule\Timeslot;

/**
 * @property Timeslot $data
 */
class TimeslotCell extends Cell
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->data->name;
    }

    /**
     * @return string
     */
    public function getInterval(): string
    {
        return '(' . $this->data->getInterval() . ')';
    }
}
