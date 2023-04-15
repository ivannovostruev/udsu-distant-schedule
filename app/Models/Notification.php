<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @package App\Models
 *
 * @property int $id
 * @property int $user_from
 * @property int $user_to
 * @property string $full_message
 * @property string $small_message
 * @property string $component
 * @property string $link
 * @property string $data
 * @property string $url
 * @property string $time_read
 * @property string $time_created
 */
class Notification extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_from',
        'user_to',
        'full_message',
        'small_message',
        'component',
        'data',
        'url',
        'time_read',
        'time_created',
    ];

    /**
     * @return BelongsTo
     */
    public function userFrom(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_from',
            'id',
            'users'
        );
    }

    /**
     * @return BelongsTo
     */
    public function userTo(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_to',
            'id',
            'users'
        );
    }
}
