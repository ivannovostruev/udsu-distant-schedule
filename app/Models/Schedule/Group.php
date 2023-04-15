<?php

namespace App\Models\Schedule;

use App\Models\Filterable;
use App\Models\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property int $id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 */
class Group extends Model
{
    use HasFactory;
    use Filterable;
    use Sortable;

    protected $fillable = [
        'name',
    ];

    /**
     * @return BelongsToMany
     */
    public function lessons(): BelongsToMany
    {
        return $this->belongsToMany(Lesson::class);
    }
}
