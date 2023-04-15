<?php

namespace App\ModelServices;

use App\Events\LessonCreated;
use App\Models\Schedule\Lesson;
use App\Models\Schedule\LessonPeriodicity;
use App\Models\Schedule\LessonStatus;
use App\ModelServices\Exceptions\ModelServiceException;
use App\Utilities\PeriodicityDatesProvider;
use ErrorException;
use Illuminate\Database\Eloquent\Model;

class LessonService extends ModelService
{
    private const CREATE_ERROR_MESSAGE = 'Не удалось создать занятие в базе данных';
    private const UPDATE_ERROR_MESSAGE = 'Не удалось обновить занятие в базе данных';

    /**
     * @param Lesson $model
     * @param array $data
     * @return mixed
     * @throws ModelServiceException
     */
    public function create(Model $model, array $data): void
    {
        $multiDateMode  = $data['multi_date_mode']; // многодневный режим
        $periodicity    = $data['periodicity'];     // периодичность

        $this->guardChooseDateCorrect($multiDateMode, $periodicity);
        $this->guardRoomDefined($data);

        if ($multiDateMode) {
            $this->createWhenManyDates($model, $data);
        } else if ($this->periodicityIsOnce($periodicity)) {
            $this->createOnTimeslots($model, $data);
        } else {
            $data['dates'] = $this->getDatesFromPeriodicity($periodicity, $data);
            $this->createWhenManyDates($model, $data);
        }
    }

    /**
     * @param int $periodicity
     * @param array $data
     * @return array
     * @throws ModelServiceException
     */
    private function getDatesFromPeriodicity(int $periodicity, array $data): array
    {
        try {
            return PeriodicityDatesProvider::get($periodicity, $data);
        } catch (ErrorException $e) {
            throw new ModelServiceException($e->getMessage());
        }
    }

    /**
     * @param Lesson $model
     * @param array $data
     * @return void
     * @throws ModelServiceException
     */
    public function update(Model $model, array $data): void
    {
        $lesson     = $model;
        $groupsIds  = $data['groups'];
        $reasonsIds = $data['reasons'];

        $this->guardRoomDefined($data);
        $this->guardCellNotBusy($data, true, $lesson);

        if (!$lesson->update($data)) {
            throw new ModelServiceException(self::UPDATE_ERROR_MESSAGE);
        }

        $this->syncGroups($lesson, $groupsIds);
        $this->syncReasons($lesson, $reasonsIds);
    }

    /**
     * @param Lesson $model
     * @return bool
     */
    public function delete(Model $model): bool
    {
        $lesson = $model;

        $lesson->groups()->detach();
        $lesson->reasons()->detach();

        return (bool) $lesson->delete();
    }

    /**
     * @param Model $model
     * @param array $data
     * @return void
     * @throws ModelServiceException
     */
    private function createWhenManyDates(Model $model, array $data): void
    {
        foreach ($data['dates'] as $date) {
            $data['date'] = $date;
            $this->createOnTimeslots($model, $data);
        }
    }

    /**
     * @param Model $model
     * @param array $data
     * @return void
     * @throws ModelServiceException
     */
    private function createOnTimeslots(Model $model, array $data): void
    {
        foreach ($data['timeslots'] as $timeslot) {
            $data['timeslot_id'] = $timeslot;

            $groupsIds  = $data['groups'];
            $reasonsIds = $data['reasons'];

            $this->guardCellNotBusy($data);

            if (!$lesson = $model->create($data)) {
                throw new ModelServiceException(self::CREATE_ERROR_MESSAGE);
            }

            $this->attachGroups($lesson, $groupsIds);
            $this->attachReasons($lesson, $reasonsIds);
            //$this->addCreatedEvent($lesson);
        }
    }

    /**
     * @param Lesson $lesson
     * @param array $groupIds
     */
    private function attachGroups(Lesson $lesson, array $groupIds): void
    {
        $lesson->groups()->attach($groupIds);
    }

    /**
     * @param Lesson $lesson
     * @param array $reasonIds
     */
    private function attachReasons(Lesson $lesson, array $reasonIds): void
    {
        $lesson->groups()->attach($reasonIds);
    }

    /**
     * @param Lesson $lesson
     */
    private function addCreatedEvent(Lesson $lesson): void
    {
        event(new LessonCreated($lesson));
    }

    /**
     * @param Lesson $lesson
     * @param array $groupIds
     */
    private function syncGroups(Lesson $lesson, array $groupIds): void
    {
        $lesson->groups()->sync($groupIds);
    }

    /**
     * @param Lesson $lesson
     * @param array $reasonIds
     */
    private function syncReasons(Lesson $lesson, array $reasonIds): void
    {
        $lesson->reasons()->sync($reasonIds);
    }

    /**
     * @param array $data
     * @throws ModelServiceException
     */
    private function guardRoomDefined(array $data): void
    {
        $errorMessage = 'Комната не определена';

        $status = $data['status'];
        $roomId = $data['room_id'];

        if (is_null($roomId) && $status === LessonStatus::APPROVED) {
            throw new ModelServiceException($errorMessage);
        }
    }

    /**
     * @param array $data
     * @param bool $onUpdate
     * @param Lesson|null $lesson
     * @throws ModelServiceException
     */
    private function guardCellNotBusy(array $data, bool $onUpdate = false, ?Lesson $lesson = null): void
    {
        $errorMessage = 'Ячейка занята другим занятием';

        $roomId = $data['room_id'];

        if (!is_null($roomId) && $this->isCellBusy($data, $onUpdate, $lesson)) {
            throw new ModelServiceException($errorMessage);
        }
    }

    /**
     * @param array $data
     * @param bool $onUpdate
     * @param Lesson|null $lesson
     * @return bool
     */
    private function isCellBusy(array $data, bool $onUpdate = false, ?Lesson $lesson = null): bool
    {
        $occupantLesson = $this->findOccupantLesson($data);

        return $onUpdate
            ? !empty($occupantLesson) && $occupantLesson->id !== $lesson->id
            : !is_null($this->findOccupantLesson($data));
    }

    /**
     * @param array $data
     * @return mixed
     */
    private function findOccupantLesson(array $data): mixed
    {
        $commonCondition = [
            ['date', '=', $data['date']],
            ['timeslot_id', '=', $data['timeslot_id']],
            ['room_id', '=', $data['room_id']],
        ];
        $additionalCondition1 = [['status', '=', LessonStatus::APPROVED]];
        $additionalCondition2 = [['status', '=', LessonStatus::CANCELED]];

        $conditions1 = array_merge($commonCondition, $additionalCondition1);
        $conditions2 = array_merge($commonCondition, $additionalCondition2);

        $occupantLesson = Lesson::where($conditions1)->orWhere($conditions2)->first();

        return !empty($occupantLesson) ? $occupantLesson : null;
    }

    /**
     * @param bool $multiDateMode
     * @param int|null $periodicity
     * @throws ModelServiceException
     */
    private function guardChooseDateCorrect(bool $multiDateMode, ?int $periodicity): void
    {
        if ($multiDateMode && !is_null($periodicity)) {
            throw new ModelServiceException('Неправильный способ указания даты');
        }
    }

    /**
     * @param int|null $periodicity
     * @return bool
     */
    private function periodicityIsOnce(?int $periodicity): bool
    {
        return is_null($periodicity) || $periodicity === LessonPeriodicity::ONCE;
    }
}
