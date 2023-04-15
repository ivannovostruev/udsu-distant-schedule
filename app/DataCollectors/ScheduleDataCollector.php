<?php

namespace App\DataCollectors;

use App\Models\Schedule\Cells\DefaultCellColors;
use App\Models\Schedule\Color;
use App\Models\Schedule\Grid;
use App\Models\Schedule\LessonStatus;
use App\Repositories\LessonRepository;
use App\Repositories\RoomRepository;
use App\Repositories\TimeslotRepository;
use App\Utilities\RoomHelper;
use Illuminate\Database\Eloquent\Collection as DbCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ScheduleDataCollector extends DataCollector
{
    use ViewData;

    const DATE_FORMAT = 'Y-m-d';

    /**
     * @var string В формате 2022-08-22
     */
    protected string $date;

    protected LessonRepository $lessonRepository;
    protected TimeslotRepository $timeslotRepository;
    protected RoomRepository $roomRepository;

    /**
     * @param LessonRepository $lessonRepository
     * @param TimeslotRepository $timeslotRepository
     * @param RoomRepository $roomRepository
     */
    public function __construct(
        LessonRepository $lessonRepository,
        TimeslotRepository $timeslotRepository,
        RoomRepository $roomRepository
    ) {
        $this->setDefaultDate();

        $this->lessonRepository     = $lessonRepository;
        $this->timeslotRepository   = $timeslotRepository;
        $this->roomRepository       = $roomRepository;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getGridViewData(Request $request): array
    {
        $this->defineDateFromRequest($request);

        $this->viewData['grid']          = $this->getGrid();
        $this->viewData['date']          = $this->date;
        $this->viewData['colors']        = Color::all();
        $this->viewData['roomHelper']    = $this->getRoomHelper();
        $this->viewData['defaultColors'] = DefaultCellColors::getWithDescription();

        return $this->viewData;
    }

    /**
     * @return Grid
     */
    public function getGrid(): Grid
    {
        return new Grid(
            $this->getLessonForGrid(
                $this->getLessonConditionOne(),
                $this->getLessonConditionTwo()
            ),
            $this->getTimeslotForGrid(),
            $this->getRoomsForGrid()
        );
    }

    /**
     * @return void
     */
    private function setDefaultDate(): void
    {
        $this->date = today()->format(self::DATE_FORMAT);
    }

    /**
     * @param Request $request
     * @return void
     */
    private function defineDateFromRequest(Request $request): void
    {
        $this->date = (string) $request->query('date', $this->date);
    }

    /**
     * @param array $conditionsOne
     * @param array $conditionsTwo
     * @return DbCollection
     */
    private function getLessonForGrid(array $conditionsOne, array $conditionsTwo): DbCollection
    {
        return $this->lessonRepository->getLessonsForGrid($conditionsOne, $conditionsTwo);
    }

    /**
     * @return Collection
     */
    private function getTimeslotForGrid(): Collection
    {
        return $this->timeslotRepository->getTimeslotForGrid();
    }

    /**
     * @return Collection
     */
    private function getRoomsForGrid(): Collection
    {
        return $this->roomRepository->getRoomsForGrid();
    }

    /**
     * @return array
     */
    private function getLessonConditionOne(): array
    {
        return [
            ['date', '=', $this->date],
            ['status', '=', LessonStatus::APPROVED],
        ];
    }

    /**
     * @return array
     */
    private function getLessonConditionTwo(): array
    {
        return [
            ['date', '=', $this->date],
            ['status', '=', LessonStatus::CANCELED],
        ];
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    /**
     * @return RoomHelper
     */
    private function getRoomHelper(): RoomHelper
    {
        return new RoomHelper($this->lessonRepository, $this->timeslotRepository);
    }
}
