<?php

namespace App\Models\Schedule\Cells;

use Illuminate\Database\Eloquent\Model;

class Cell
{
    public Model $data;

    /**
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->data->id ?? null;
    }

    /**
     * @return bool
     */
    public function typeIsLesson(): bool
    {
        return $this instanceof LessonCell;
    }

    /**
     * @return bool
     */
    public function typeIsTimeslot(): bool
    {
        return $this instanceof TimeslotCell;
    }

    /**
     * @return bool
     */
    public function typeIsRoom(): bool
    {
        return $this instanceof RoomCell;
    }

    /**
     * @return bool
     */
    public function typeIsEmpty(): bool
    {
        return $this instanceof EmptyCell;
    }
}
