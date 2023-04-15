<?php

namespace App\ModelServices;

use App\Models\Schedule\Room;
use Illuminate\Database\Eloquent\Model;

class RoomService extends ModelService
{
    /**
     * @param Room $model
     * @return bool|null
     */
    public function delete(Model $model): ?bool
    {
        $this->unbindLessonsFromRoom($model);

        return $model->delete();
    }

    /**
     * @param Room $room
     */
    private function unbindLessonsFromRoom(Room $room): void
    {
        $lessons = $room->lessons();
        if ($lessons->count() > 0) {
            foreach ($lessons->get() as $lesson) {
                /** @var \App\Models\Schedule\Lesson $lesson */
                $lesson->room_id = null;
                $lesson->save();
            }
        }
    }
}
