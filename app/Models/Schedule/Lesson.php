<?php
/**
 * Во имя Творца!
 * С помощью небес!
 *
 * @copyright   2022 Ivan Novostruev emsitef@gmail.com
 */

namespace App\Models\Schedule;

use App\Models\Filterable;
use App\Models\Sortable;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

/**
 * @package App\Models\Schedule
 *
 * @property int $id
 * @property string $name Название занятия
 * @property string $date Дата проведения занятия
 * @property int $periodicity Периодичность проведения занятий
 * @property string $expiration_date Дата окончания занятий, проводимых с определённой периодичностью
 * @property int $teacher_id Преподаватель/спикер, ассоциированный с занятием
 * @property int $education_level Уровень образования
 * @property int $type Тип занятия
 * @property int $system_type Тип системы видеоконференций
 * @property int $link_type Тип ссылки
 * @property int $location Место проведения
 * @property string $link Ссылка на занятие
 * @property string $commentary Комментарий методиста к занятию
 * @property int $should_record Флаг, нужно ли записывать видеоконференцию
 * @property array $special_requirements Специальные требования для проведения занятия
 * @property int $timeslot_id Таймслот
 * @property int|null $room_id Комната
 * @property int|null $color_id Цвет ячейки
 * @property string $admin_feedback Комментарий администратора
 * @property string $connect_info Ссылка для подключения, генерируется автоматически
 * @property int $status Статус занятия
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class Lesson extends Model
{
    use HasFactory;
    use Filterable;
    use Sortable;

    protected $fillable = [
        'name',
        'date',
        'teacher_id',
        'education_level',
        'type',
        'system_type',
        'link_type',
        'location',
        'link',
        'commentary',
        'should_record',
        'special_requirements',
        'timeslot_id',
        'color_id',
        'room_id',
        'admin_feedback',
        'status',
        'created_by',
        'updated_by',
    ];

    protected ?Collection $timeslotCollection = null;
    protected ?Collection $groupCollection = null;
    protected ?Collection $reasonCollection = null;

    /**
     * @return BelongsToMany
     */
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class);
    }

    /**
     * @return BelongsToMany
     */
    public function reasons(): BelongsToMany
    {
        return $this->belongsToMany(Reason::class);
    }

    /**
     * @return BelongsTo
     */
    public function timeslot(): BelongsTo
    {
        return $this->belongsTo(Timeslot::class);
    }

    /**
     * @return BelongsTo
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * @return BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'created_by',
            'id',
            'users'
        );
    }

    /**
     * @return BelongsTo
     */
    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class);
    }

    /**
     * @return BelongsTo
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * @param Group $group
     * @return bool
     */
    public function groupIsAttached(Group $group): bool
    {
        if (is_null($this->groupCollection)) {
            $this->groupCollection = $this->groups()->get();
        }
        return $this->groupCollection->contains($group);
    }

    /**
     * @param Reason $reason
     * @return bool
     */
    public function reasonIsAttached(Reason $reason): bool
    {
        if (is_null($this->reasonCollection)) {
            $this->reasonCollection = $this->reasons()->get();
        }
        return $this->reasonCollection->contains($reason);
    }

    /**
     * @param $value
     */
    public function setSpecialRequirementsAttribute($value): void
    {
        $this->attributes['special_requirements'] = implode(',', $value);
    }

    /**
     * @param $value
     * @return array
     */
    public function getSpecialRequirementsAttribute($value): array
    {
        return explode(',', $value);
    }

    /**
     * @return string[]
     */
    public function getAllKindsPeriodicity(): array
    {
        return LessonPeriodicity::PERIODICITY_WITH_NAME;
    }

    /**
     * @return string[]
     */
    public function getTypes(): array
    {
        return LessonType::TYPES_WITH_NAME;
    }

    /**
     * @return string[]
     */
    public function getSystemTypes(): array
    {
        return LessonSystemType::SYSTEM_TYPES_WITH_NAMES;
    }

    /**
     * @return string[]
     */
    public function getLinkTypes(): array
    {
        return LessonLinkType::LINK_TYPES_WITH_NAME;
    }

    /**
     * @return string[]
     */
    public function getLocations(): array
    {
        return LessonLocation::LOCATIONS_WITH_NAME;
    }

    /**
     * @return string[]
     */
    public function getSpecialRequirements(): array
    {
        return LessonSpecialRequirement::SPECIAL_REQUIREMENTS_WITH_NAME;
    }

    /**
     * @return string[]
     */
    public static function getStatuses(): array
    {
        return LessonStatus::STATUSES_WITH_NAME;
    }

    /**
     * @return string[]
     */
    public function getEducationLevels(): array
    {
        return LessonEducationLevel::EDUCATION_LEVELS_WITH_NAME;
    }

    /**
     * @param int $statusCode
     * @return bool
     */
    public static function statusExists(int $statusCode): bool
    {
        return LessonStatus::exists($statusCode);
    }

    /**
     * @return string
     */
    public function getStatusAsWord(): string
    {
        return LessonStatus::STATUSES_WITH_NAME[$this->status] ?? '';
    }

    /**
     * @return string
     */
    public function getStatusCssClass(): string
    {
        return LessonStatus::getCssClass($this->status);
    }

    /**
     * @return string
     */
    public function getDateToShow(): string
    {
        return Date::parse($this->date)->format('d F Y');
    }

    /**
     * @return string
     */
    public function getPeriodicityName(): string
    {
        return LessonPeriodicity::PERIODICITY_WITH_NAME[$this->periodicity] ?? '';
    }

    /**
     * @return string
     */
    public function getSystemTypeName(): string
    {
        return LessonSystemType::SYSTEM_TYPES_WITH_NAMES[$this->system_type] ?? '';
    }

    /**
     * @return string
     */
    public function getTypeName(): string
    {
        return LessonType::TYPES_WITH_NAME[$this->type] ?? '';
    }

    /**
     * @return string
     */
    public function getLinkTypeName(): string
    {
        return LessonLinkType::LINK_TYPES_WITH_NAME[$this->link_type] ?? '';
    }

    /**
     * @return string
     */
    public function getLocationName(): string
    {
        return LessonLocation::LOCATIONS_WITH_NAME[$this->location] ?? '';
    }

    /**
     * @return string
     */
    public function getShouldRecord(): string
    {
        return $this->should_record ? 'да' : 'нет';
    }

    /**
     * @return string
     */
    public function getExpirationDateToShow(): string
    {
        if ($this->periodicity === LessonPeriodicity::ONCE) {
            return Date::parse($this->date)->format('d F Y');
        }
        return 'не установлена';
    }

    /**
     * @return int
     */
    public function getDefaultPeriodicity(): int
    {
        return LessonPeriodicity::ONCE;
    }

    /**
     * @return int
     */
    public function getDefaultStatus(): int
    {
        return Auth::user()->isAdmin()
            ? LessonStatus::APPROVED
            : LessonStatus::REQUESTED;
    }

    /**
     * @return int
     */
    public function getDefaultSystemType(): int
    {
        return LessonSystemType::MIRAPOLIS;
    }

    /**
     * @return int
     */
    public function getDefaultLocation(): int
    {
        return LessonLocation::CENTER;
    }

    /**
     * @return int
     */
    public function getDefaultType(): int
    {
        return LessonType::NO;
    }

    /**
     * @return string
     */
    public function getDefaultDate(): string
    {
        $format = 'Y-m-d'; //пример '2022-09-03'

        return Carbon::now()->format($format);
    }

    /**
     * @return bool
     */
    public function statusIsDraft(): bool
    {
        return $this->status === LessonStatus::DRAFT;
    }

    /**
     * @return bool
     */
    public function isApproved(): bool
    {
        return $this->status === LessonStatus::APPROVED;
    }

    /**
     * @return bool
     */
    public function isRequested(): bool
    {
        return $this->status === LessonStatus::REQUESTED;
    }

    /**
     * @return bool
     */
    public function isNotApproved(): bool
    {
        return $this->status !== LessonStatus::APPROVED;
    }

    /**
     * @return bool
     */
    public function isCanceled(): bool
    {
        return $this->status === LessonStatus::CANCELED;
    }

    /**
     * @return bool
     */
    public function isShouldRecord(): bool
    {
        return $this->should_record;
    }

    /**
     * @return bool
     */
    public function linkTypeIsIndividual(): bool
    {
        return $this->link_type === LessonLinkType::INDIVIDUAL;
    }

    /**
     * @return int
     */
    public function getDefaultLinkType(): int
    {
        return LessonLinkType::TYPICAL;
    }
}
