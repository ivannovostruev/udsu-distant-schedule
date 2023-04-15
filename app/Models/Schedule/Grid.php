<?php

namespace App\Models\Schedule;

use App\Models\Schedule\Cells\CellProvider;
use Illuminate\Database\Eloquent\Collection as DbCollection;
use Illuminate\Support\Collection;
use stdClass;

class Grid
{
    private DbCollection $lessons;
    private Collection $timeslots;
    private Collection $rooms;

    /**
     *
     */
    public function __construct(
        DbCollection $lessons,
        Collection $timeslots,
        Collection $rooms
    ) {
        $this->lessons     = $lessons;
        $this->timeslots   = $timeslots;
        $this->rooms       = $rooms;
    }

    /**
     * @return Collection
     */
    public function getHead(): Collection
    {
        $emptyCell = new stdClass();

        $row = clone $this->rooms;
        $row->prepend($emptyCell);

        return $row;
    }

    /**
     * Main algorithm!
     *
     * @return Collection
     */
    public function getBody(): Collection
    {
        $collection = collect();

        foreach ($this->timeslots as $timeslot) {
            $timeslotLessons = $this->getTimeslotLessons($this->lessons, $timeslot);
            $rowOfObjects = $this->getRowOfObjects($this->rooms, $timeslotLessons);
            $rowOfObjects->prepend($timeslot);
            $rowOfCells = $this->getRowOfCells($rowOfObjects);
            $collection->push($rowOfCells);
        }
        return $collection;
    }

    /**
     * Выбирает из коллекции занятий, только те занятия,
     * которые относятся к указанной комнате
     *
     * @param DbCollection $lessons
     * @param Timeslot $timeslot
     * @return DbCollection
     */
    private function getTimeslotLessons(DbCollection $lessons, Timeslot $timeslot): DbCollection
    {
        return $lessons->filter(function ($lesson) use ($timeslot) {
            $lessonTimeslots = $lesson->timeslot()->get();
            foreach ($lessonTimeslots as $lessonTimeslot) {
                if ($lessonTimeslot->id == $timeslot->id) {
                    return true;
                }
            }
            return false;
        });
    }

    /**
     * @param Collection $rooms
     * @param DbCollection $timeslotLessons
     * @return Collection
     */
    private function getRowOfObjects(Collection $rooms, DbCollection $timeslotLessons): Collection
    {
        return $rooms->map(function ($room) use ($timeslotLessons) {
            foreach ($timeslotLessons as $lesson) {
                /** @var Lesson $lesson */
                if ($lesson->room_id == $room->id) {
                    return $lesson;
                }
            }
            return $room;
        });
    }

    /**
     * @param Collection $objects
     * @return Collection
     */
    private function getRowOfCells(Collection $objects): Collection
    {
        return $objects->map(function ($object) {
            return CellProvider::get($object);
        });
    }
}
