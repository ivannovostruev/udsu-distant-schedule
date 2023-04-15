<?php

namespace App\Models;

use App\Models\Schedule\Lesson;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


/**
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $email
 * @property string $email_verified_at
 * @property string $password
 * @property int $role_id
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use Filterable;
    use Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'external_id',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return HasMany
     */
    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class, 'user_to');
    }

    /**
     * @return BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role_id === Role::ADMIN_ID;
    }

    /**
     * @return bool
     */
    public function isManager(): bool
    {
        return $this->role_id === Role::MANAGER_ID;
    }

    /**
     * @return bool
     */
    public function isCreator(): bool
    {
        return $this->role_id === Role::CREATOR_ID;
    }

    /**
     * @return bool
     */
    public function isAdminOrManagerOrCreator(): bool
    {
        return in_array($this->role_id, [
                Role::ADMIN_ID,
                Role::MANAGER_ID,
                Role::CREATOR_ID
        ]);
    }

    /**
     * @return bool
     */
    public function isAdminOrManager(): bool
    {
        return $this->isAdmin() || $this->isManager();
    }

    /**
     * @param Lesson $lesson
     * @return bool
     */
    public function isLessonCreator(Lesson $lesson): bool
    {
        return $this->id === $lesson->created_by;
    }

    /**
     * @param Lesson $lesson
     * @return bool
     */
    public function isLessonEditor(Lesson $lesson): bool
    {
        return $this->isAdmin()
            || $this->isManager()
            || ($this->isLessonCreator($lesson) && $lesson->statusIsDraft());
    }

    /**
     * @return bool
     */
    public function isAuthorized(): bool
    {
        return $this->role_id === null;
    }
}
