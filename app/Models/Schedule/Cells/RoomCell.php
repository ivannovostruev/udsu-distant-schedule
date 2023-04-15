<?php

namespace App\Models\Schedule\Cells;

use App\Models\Schedule\Room;

/**
 * @property Room $data
 */
class RoomCell extends Cell
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->data->name;
    }
}
