<?php

namespace App\Models\Schedule;

use App\Models\Filterable;
use App\Models\Sortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $full_name
 * @property string $email
 * @property string $description
 * @property int $associated_user_id
 * @property string $created_at
 * @property string $updated_at
 */
class Teacher extends Model
{
    use HasFactory;
    use Filterable;
    use Sortable;

    protected $fillable = [
        'full_name',
        'email',
        'description',
    ];

    /**
     * @return HasMany
     */
    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }
}
