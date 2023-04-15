<?php

namespace App\Repositories;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Collection;

class NotificationRepository extends BaseRepository
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Notification::class;
    }

    /**
     * @return mixed
     */
    public function getByUserId(int $userId): Collection
    {
        return $this->startCondition()->where('user_to', $userId)->get();
    }
}
