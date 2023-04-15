<?php

namespace App\Models\Schedule;

use App\Utilities\ColorHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $hex
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 */
class Color extends Model
{
    use HasFactory;

    protected $fillable = [
        'hex',
        'description',
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
    public function getTextColorCssClass(): string
    {
        return ColorHelper::determineColorTone($this->hex) ? 'text-dark' : 'text-light';
    }

    /**
     * @param $value
     * @return string
     */
    public function getDescriptionAttribute($value): string
    {
        return Str::limit($value, 200) ?? '';
    }
}
