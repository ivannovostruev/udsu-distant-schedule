<?php

namespace App\Utilities;

use App\Models\Schedule\Lesson;
use App\Models\Schedule\Timeslot;
use App\Repositories\LessonRepository;
use App\Repositories\TimeslotRepository;
use Illuminate\Support\Collection;

class RoomHelper
{
    const DEFAULT_TIMEZONE = 'Europe/Samara';

    private LessonRepository $lessonRepository;
    private TimeslotRepository $timeslotRepository;

    private Collection $timeslots;

    private string $currentTime;

    private ?Timeslot $currentTimeslot  = null;
    private ?Timeslot $upcomingTimeslot = null;

    /**
     * @var array Текущие комнаты
     */
    private array $currentRooms = [];

    /**
     * @var array Предстоящие комнаты
     */
    private array $upcomingRooms = [];

    /**
     * @param LessonRepository $lessonRepository
     * @param TimeslotRepository $timeslotRepository
     */
    public function __construct(LessonRepository $lessonRepository, TimeslotRepository $timeslotRepository)
    {
        $this->lessonRepository     = $lessonRepository;
        $this->timeslotRepository   = $timeslotRepository;

        $this->setTimeslots();
        $this->setCurrentTime();

        $this->defineCurrentAndUpcomingTimeslots();
        $this->setCurrentRooms($this->currentTimeslot);
        $this->setUpcomingRooms($this->upcomingTimeslot);
    }

    private function setTimeslots(): void
    {
        $this->timeslots = $this->timeslotRepository->getAll();
    }

    /**
     * @return void
     */
    private function setCurrentTime(): void
    {
        //date_default_timezone_set(self::DEFAULT_TIMEZONE);
        $this->currentTime = date('H:i:s', time());
    }

    /**
     * @return Timeslot|null
     */
    public function getCurrentTimeslot(): ?Timeslot
    {
        return $this->currentTimeslot;
    }

    /**
     * @return Timeslot|null
     */
    public function getUpcomingTimeslot(): ?Timeslot
    {
        return $this->upcomingTimeslot;
    }

    /**
     * @param Timeslot|null $currentTimeslot
     */
    public function setCurrentRooms(?Timeslot $currentTimeslot): void
    {
        $this->currentRooms = $this->getRoomsByTimeslot($currentTimeslot);
    }

    /**
     * @return array
     */
    public function getCurrentRooms(): array
    {
        return $this->currentRooms;
    }

    /**
     * @param Timeslot|null $upcomingTimeslot
     */
    public function setUpcomingRooms(?Timeslot $upcomingTimeslot): void
    {
        $this->upcomingRooms = $this->getRoomsByTimeslot($upcomingTimeslot);
    }

    /**
     * @return array
     */
    public function getUpcomingRooms(): array
    {
        return $this->upcomingRooms;
    }

    /**
     * @param array $rooms
     * @return string
     */
    private function getRoomsAsString(array $rooms): string
    {
        return implode(', ', $rooms);
    }

    /**
     * @return void
     */
    private function defineCurrentAndUpcomingTimeslots(): void
    {
        $currentTime    = $this->currentTime;
        $timeslots      = $this->timeslots;
        $length         = $timeslots->count();

        foreach ($timeslots as $key => $timeslot) {
            /** @var Timeslot $timeslot */

            if ($key === 0 && $currentTime < $timeslot->start_time) {
                $this->upcomingTimeslot = $timeslot;
                break;
            }

            if ($key === ($length - 1) && $currentTime > $timeslot->end_time) {
                break;
            }

            if ($key === ($length - 1)) {
                $this->currentTimeslot = $timeslot;
                break;
            }

            $nextTimeslot = $timeslots[$key + 1];
            if (
                $currentTime >= $timeslot->start_time
                && $currentTime < $nextTimeslot->start_time
            ) {
                $this->currentTimeslot = $timeslot;
                $this->upcomingTimeslot = $nextTimeslot;
                break;
            }
        }
    }

    /**
     * @param Timeslot|null $timeslot
     * @return array
     */
    private function getRoomsByTimeslot(?Timeslot $timeslot): array
    {
        if (is_null($timeslot)) {
            return [];
        }

        $lessons = $this->getLessonsByTimeslotId($timeslot->id);
        if ($lessons->count() === 0) {
            return [];
        }

        $rooms = [];
        foreach ($lessons as $lesson) {
            /** @var Lesson $lesson */
            if (!is_null($lesson->room)) {
                $rooms[] = $lesson->room->name;
            }
        }
        return $rooms;
    }

    /**
     * @param int $timeslotId
     * @return mixed
     */
    private function getLessonsByTimeslotId(int $timeslotId): mixed
    {
        return $this->lessonRepository->getByTimeslotId($timeslotId);
    }
}
