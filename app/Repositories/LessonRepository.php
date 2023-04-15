<?php

namespace App\Repositories;

use App\Models\Schedule\Lesson;
use App\Models\Schedule\LessonEducationLevel;
use App\QueryFilters\LessonFilter;
use App\Sorters\LessonSorter;
use Auth;
use Illuminate\Database\Eloquent\Collection;

class LessonRepository extends BaseRepository
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Lesson::class;
    }

    /**
     * @param LessonFilter $filter
     * @param LessonSorter $sorter
     * @param int $perPage
     * @return mixed
     */
    public function getWithPaginate(
        LessonFilter $filter,
        LessonSorter $sorter,
        int $perPage
    ): mixed {
        $user = Auth::user();

        $query = Lesson::filter($filter);

        if ($user->isCreator()) {
            $query = $query->where('created_by', '=', $user->id);
        }

        if ($user->isManager()) {
            $managersEducationLevels = [
                LessonEducationLevel::BACHELOR,
                LessonEducationLevel::SPECIALIST,
                LessonEducationLevel::MASTER,
            ];
            $query = $query->whereIn('education_level', $managersEducationLevels);
        }

        return $query->select($this->getPaginateColumns())
            ->sort($sorter)
            ->paginate($perPage)
            ->withQueryString();
    }

    /**
     * @param array $conditionOne
     * @param array $conditionTwo
     * @return Collection
     */
    public function getLessonsForGrid(array $conditionOne, array $conditionTwo): Collection
    {
        $order = 'room_id';

        $lessons = Lesson::where($conditionOne)
            ->orWhere($conditionTwo)
            ->orderBy($order)
            ->get();

        return $lessons;
    }

    /**
     * @return string[]
     */
    private function getPaginateColumns(): array
    {
        return ['lessons.*'];
    }

    /**
     * @param int $timeslotId
     * @return mixed
     */
    public function getByTimeslotId(int $timeslotId): mixed
    {
        $date = date('Y-m-d');

        return Lesson::orderBy('room_id')
            ->where('timeslot_id', $timeslotId)
            ->where('date', $date)
            ->get();
    }
}
