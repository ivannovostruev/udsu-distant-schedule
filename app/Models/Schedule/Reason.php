<?php

namespace App\Models\Schedule;

use App\Models\Filterable;
use App\Models\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @package App\Models\Schedule
 *
 * @property int $id
 * @property string $shortname Короткое название - шифр
 * @property string $name Название
 * @property int $type Тип
 * @property string $created_at
 * @property string $updated_at
 */
class Reason extends Model
{
    use HasFactory;
    use Filterable;
    use Sortable;

    protected $fillable = [
        'shortname',
        'name',
        'type',
        'created_by',
        'updated_by',
    ];

    /**
     * @return BelongsToMany
     */
    public function lessons(): BelongsToMany
    {
        return $this->belongsToMany(Lesson::class);
    }

    /**
     * @return string[]
     */
    public function getTypes(): array
    {
        return ReasonType::TYPES_WITH_NAME;
    }

    /**
     * @return int
     */
    public function getDefaultType(): int
    {
        return ReasonType::APPROVED;
    }

    /**
     * @return string
     */
    public function getTypeName(): string
    {
        return ReasonType::TYPES_WITH_NAME[$this->type];
    }

    /**
     * @return mixed
     */
    public static function getByTypeApproved(): mixed
    {
        $condition = ['type' => ReasonType::APPROVED];

        return Reason::where($condition)->get();
    }

    /**
     * @return mixed
     */
    public static function getByTypeRejected(): mixed
    {
        $condition = ['type' => ReasonType::REJECTED];

        return Reason::where($condition)->get();
    }
}
