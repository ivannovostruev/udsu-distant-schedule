<?php

namespace App\DataCollectors;

use App\DataCollectors\Exceptions\DataCollectorException;
use App\Models\Schedule\Color;
use App\Models\Schedule\Group;
use App\Models\Schedule\Lesson;
use App\Models\Schedule\LessonLinkType;
use App\Models\Schedule\LessonPeriodicity;
use App\Models\Schedule\LessonStatus;
use App\Models\Schedule\Reason;
use App\Models\Schedule\Room;
use App\Models\Schedule\Teacher;
use App\Models\Schedule\Timeslot;
use App\Models\User;
use App\QueryFilters\LessonFilter;
use App\Repositories\LessonRepository;
use App\Sorters\LessonSorter;
use App\Support\Abilities\RoomAbilities;
use App\Support\Abilities\TeacherAbilities;
use App\Support\Abilities\UserAbilities;
use App\UdsuServices\Exceptions\DataServiceException;
use App\Utilities\DatesDataHandler;
use App\Utilities\LessonStatusRadioButtons;
use App\Utilities\LessonStatusResolver;
use ErrorException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @property LessonRepository $repository
 */
class LessonDataCollector extends BaseDataCollector
{
    use SortLinkGetter;

    /**
     * @param Request $request
     * @return LessonFilter
     */
    protected function getFilter(Request $request): LessonFilter
    {
        return new LessonFilter($request);
    }

    /**
     * @param Request $request
     * @return LessonSorter
     */
    protected function getSorter(Request $request): LessonSorter
    {
        return new LessonSorter($request);
    }

    /**
     * @param Request|null $request
     * @return array
     */
    public function getIndexViewData(?Request $request = null): array
    {
        $sorter             = $this->getSorter($request);
        $filter             = $this->getFilter($request);
        $perPageSelector    = $this->getPerPageSelector($request);
        $perPage            = $perPageSelector->getPerPage();

        $this->viewData['lesson']           = new Lesson();
        $this->viewData['timeslots']        = Timeslot::all();
        $this->viewData['teachers']         = Teacher::all();
        $this->viewData['creators']         = $this->getCreators();
        $this->viewData['groups']           = Group::all();
        $this->viewData['colors']           = Color::all();
        $this->viewData['rooms']            = Room::all();
        $this->viewData['sortLink']         = $this->getSortLink($request, $sorter->getOrder());
        $this->viewData['perPageSelector']  = $perPageSelector;
        $this->viewData['perPage']          = $perPage;
        $this->viewData['paginator']        = $this->getLessonsWithPaginate($filter, $sorter, $perPage);

        return $this->viewData;
    }

    /**
     * @param Model $model
     * @return array
     */
    public function getShowViewData(Model $model): array
    {
        $this->viewData['lesson'] = $model;

        $this->viewData['roomAbilities']    = new RoomAbilities();
        $this->viewData['teacherAbilities'] = new TeacherAbilities();
        $this->viewData['userAbilities']    = new UserAbilities();

        return $this->viewData;
    }

    /**
     * @param Lesson|null $model
     * @return array
     */
    public function getCreateViewData(?Model $model = null): array
    {
        $this->setCommonCreateAndUpdateViewData($model);
        $this->addGridInViewData($model->getDefaultDate());

        return $this->viewData;
    }

    /**
     * @param Request $request
     * @param Lesson|null $model
     * @return array
     */
    public function getFastCreateViewData(Request $request, ?Model $model = null): array
    {
        $data = $request->input();

        $this->setCommonCreateAndUpdateViewData($model);
        $this->addGridInViewData($model->getDefaultDate());

        $this->viewData['date']         = $data['date'] ?? '';
        $this->viewData['roomId']       = $data['room'] ?? '';
        $this->viewData['timeslotId']   = $data['timeslot'] ?? '';
        $this->viewData['statusCode']   = LessonStatus::APPROVED;

        return $this->viewData;
    }

    /**
     * @param Lesson $model
     * @return array
     */
    public function getEditViewData(Model $model): array
    {
        $this->setCommonCreateAndUpdateViewData($model);
        $this->addGridInViewData($model->date);

        $this->viewData['rejectedReasons'] = Reason::getByTypeRejected();
        $this->viewData['editable'] = true;

        return $this->viewData;
    }

    /**
     * @param Request $request
     * @return array
     * @throws DataCollectorException
     */
    public function getStoreData(Request $request): array
    {
        $data = $request->input();

        $user = Auth::user();

        $data['groups']             = $this->determineGroups($data);
        $data['reasons']            = $this->determineReasons($data);
        $data['link_type']          = $this->determineLinkType($data);
        $data['multi_date_mode']    = $this->determineMultiDateMode($data);
        $data['dates']              = $this->determineDates($data);
        $data['should_record']      = $this->determineShouldRecord($data);
        $data['status']             = $this->determineStatus($data, $user);
        $data['created_by']         = $this->determineCreatedBy($user);
        $data['room_id']            = $this->determineRoomId($data);
        $data['periodicity']        = $this->determinePeriodicity($data);
        $data['expiration_date']    = $this->determineExpirationDate($data);

        return $data;
    }

    /**
     * @param Request $request
     * @return array
     * @throws ErrorException
     */
    public function getUpdateData(Request $request): array
    {
        $data = $request->input();
        $user = Auth::user();

        $data['groups']         = $this->determineGroups($data);
        $data['reasons']        = $this->determineReasons($data);
        $data['room_id']        = $this->determineRoomId($data);
        $data['color_id']       = $this->determineColorId($data);
        $data['should_record']  = $this->determineShouldRecord($data);
        $data['status']         = $this->determineStatus($data, $user);

        return $data;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getApproveData(Request $request): array
    {
        $data = $request->input();

        $data['groups']     = $this->determineGroups($data);
        $data['reasons']    = $this->determineReasons($data);
        $data['room_id']    = $this->determineRoomId($data);
        $data['color_id']   = $this->determineColorId($data);
        $data['status']     = LessonStatus::APPROVED;

        return $data;
    }

    /**
     * @param Model|null $model
     */
    private function setCommonCreateAndUpdateViewData(?Model $model = null): void
    {
        $this->viewData['lesson']           = $model;
        $this->viewData['timeslots']        = Timeslot::all();
        $this->viewData['teachers']         = $this->getTeachersByName();
        $this->viewData['groups']           = $this->getGroupsByName();
        $this->viewData['colors']           = Color::all();
        $this->viewData['rooms']            = Room::all();
        $this->viewData['user']             = Auth::user();
        $this->viewData['approvedReasons']  = Reason::getByTypeApproved();

        $this->viewData['lessonStatusRadioButtons'] = new LessonStatusRadioButtons();
    }

    /**
     * @param string $date В формате 2022-08-22
     */
    private function addGridInViewData(string $date): void
    {
        $scheduleDataCollector = $this->getScheduleDataCollector();
        $scheduleDataCollector->setDate($date);

        $this->viewData['grid'] = $scheduleDataCollector->getGrid();
    }

    /**
     * @param LessonFilter $filter
     * @param LessonSorter $sorter
     * @param int $perPage
     * @return mixed
     */
    private function getLessonsWithPaginate(
        LessonFilter $filter,
        LessonSorter $sorter,
        int $perPage
    ): mixed {
        return $this->repository->getWithPaginate($filter, $sorter, $perPage);
    }

    /**
     * Из всех пользователей получаем только тех,
     * которые являются создателями занятий
     *
     * @return Collection
     */
    private function getCreators(): Collection
    {
        return User::whereIn('id', $this->getCreatorsIds())->get();
    }

    /**
     * @return array
     */
    private function getCreatorsIds(): array
    {
        $creatorsIds = [];
        $fieldName = 'created_by';

        $rows = Lesson::select($fieldName)->distinct()->get()->toArray();
        foreach ($rows as $row) {
            $creatorsIds[] = $row[$fieldName];
        }
        return $creatorsIds;
    }

    /**
     * @return mixed
     */
    private function getTeachersByName(): mixed
    {
        return Teacher::orderBy('full_name')->get();
    }

    /**
     * @return mixed
     */
    private function getGroupsByName(): mixed
    {
        return Group::orderBy('name')->get();
    }

    /**
     * @return ScheduleDataCollector
     */
    private function getScheduleDataCollector(): ScheduleDataCollector
    {
        return app(ScheduleDataCollector::class);
    }

    /**
     * @param array $data
     * @return array
     */
    private function determineGroups(array $data): array
    {
        return $data['groups'] ?? [];
    }

    /**
     * @param array $data
     * @return array
     */
    private function determineReasons(array $data): array
    {
        return $data['reasons'] ?? [];
    }

    /**
     * @param array $data
     * @return int
     * @throws DataCollectorException
     */
    private function determineLinkType(array $data): int
    {
        $linkType = !empty($data['link_type']) ? (int) $data['link_type'] : null;

        if (is_null($linkType)) {
            return LessonLinkType::TYPICAL;
        }

        if (!LessonLinkType::exists($linkType)) {
            throw new DataCollectorException('Такого типа ссылки не существует');
        }
        return $linkType;
    }

    /**
     * @param array $data
     * @return int|null
     */
    private function determineColorId(array $data): ?int
    {
        $defaultColorId = 'default';

        $colorId = $data['color_id'] ?? null;

        return is_null($colorId) || $colorId === $defaultColorId
            ? null
            : (int) $colorId;
    }

    /**
     * @param array $data
     * @param User $user
     * @return int
     * @throws DataCollectorException
     */
    private function determineStatus(array $data, User $user): int
    {
        try {
            return LessonStatusResolver::resolve($data, $user);
        } catch (ErrorException $e) {
            throw new DataCollectorException($e->getMessage());
        }
    }

    /**
     * @param array $data
     * @return int
     */
    private function determineShouldRecord(array $data): int
    {
        return !empty($data['should_record']) ? 1 : 0;
    }

    /**
     * @param User $user
     * @return int
     */
    private function determineCreatedBy(User $user): int
    {
        return $user->id;
    }

    /**
     * @param array $data
     * @return int|null
     */
    private function determineRoomId(array $data): ?int
    {
        return !empty($data['room_id']) ? (int) $data['room_id'] : null;
    }

    /**
     * @param array $data
     * @return int|null
     * @throws DataCollectorException
     */
    private function determinePeriodicity(array $data): ?int
    {
        $periodicity = !empty($data['periodicity']) ? (int) $data['periodicity'] : null;
        if (is_null($periodicity)) {
            return null;
        }
        if (!LessonPeriodicity::exists($periodicity)) {
            throw new DataCollectorException('Периодичности не существует');
        }
        return $periodicity;
    }

    /**
     * https://stackoverflow.com/questions/13194322/php-regex-to-check-date-is-in-yyyy-mm-dd-format
     *
     * @param array $data
     * @return string|null
     * @throws DataCollectorException
     */
    private function determineExpirationDate(array $data): ?string
    {
        if (is_null($data['periodicity'])) {
            return null;
        }

        $expirationDate =  $data['expiration_date'] ?? null;

        $pattern = '/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/';
        if (!preg_match($pattern, $expirationDate)) {
            throw new DataCollectorException('Некорректный формат даты окончания');
        }
        return $expirationDate;
    }

    /**
     * @param array $data
     * @return bool
     */
    private function determineMultiDateMode(array $data): bool
    {
        return !empty($data['multi_date_mode']);
    }

    /**
     * @param array $data
     * @return array
     * @throws DataCollectorException
     */
    private function determineDates(array $data): array
    {
        if ($data['multi_date_mode']) {
            try {
                return DatesDataHandler::handle($data['dates']);
            } catch (ErrorException $e) {
                throw new DataCollectorException($e->getMessage());
            }
        }
        return [];
    }
}
