<?php

namespace App\Models\Schedule\Cells;

use App\Models\Schedule\Lesson;
use App\Models\Schedule\Room;
use App\Models\Schedule\Timeslot;

class CellProvider
{
    /**
     * @param $object
     * @return Cell
     */
    public static function get($object): Cell
    {
        return match (true) {
            $object instanceof Lesson   => new LessonCell($object),
            $object instanceof Timeslot => new TimeslotCell($object),
            $object instanceof Room     => new RoomCell($object),
            default                     => new EmptyCell($object),
        };
    }
}
