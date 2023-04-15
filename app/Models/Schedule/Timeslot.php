<?php

namespace App\Models\Schedule;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $start_time
 * @property string $end_time
 * @property string $created_at
 * @property string $updated_at
 */
class Timeslot extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_time',
        'end_time',
    ];

    /**
     * @return HasMany
     */
    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }

    /**
     * @return string
     */
    public function getStartTimeWithoutSeconds(): string
    {
        return date('G:i', strtotime($this->start_time));
    }

    /**
     * @return string
     */
    public function getEndTimeWithoutSeconds(): string
    {
        return date('G:i', strtotime($this->end_time));
    }

    /**
     * @return string
     */
    public function getInterval(): string
    {
        return $this->getStartTimeWithoutSeconds() . '-' . $this->getEndTimeWithoutSeconds();
    }
}
