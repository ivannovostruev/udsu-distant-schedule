<?php

namespace App\ModelServices;

use App\Models\Schedule\Color;
use Illuminate\Database\Eloquent\Model;

class ColorService extends ModelService
{
    /**
     * @param Color $model
     * @return bool|null
     */
    public function delete(Model $model): ?bool
    {
        $this->unbindLessonsFromColor($model);

        return $model->delete();
    }

    /**
     * @param Color $color
     */
    private function unbindLessonsFromColor(Color $color): void
    {
        $lessons = $color->lessons();
        if ($lessons->count() > 0) {
            foreach ($lessons->get() as $lesson) {
                /** @var \App\Models\Schedule\Lesson $lesson */
                $lesson->color_id = null;
                $lesson->save();
            }
        }
    }
}
