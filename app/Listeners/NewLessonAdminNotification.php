<?php

namespace App\Listeners;

use App\Events\LessonCreated;
use App\Models\Notification;
use App\Models\Role;
use App\Models\Schedule\Lesson;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;

class NewLessonAdminNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param LessonCreated $event
     * @return void
     */
    public function handle(LessonCreated $event): void
    {
        $lesson = $event->lesson;

        foreach ($this->getNotifiedUsers() as $user) {
            $data = $this->getNotificationData($user, $lesson);
            Notification::create($data);
        }
    }

    /**
     * @return Collection
     */
    private function getNotifiedUsers(): Collection
    {
        return User::where('role_id', Role::ADMIN_ID)->get();
    }

    /**
     * @param User $user
     * @param Lesson $lesson
     * @return array
     */
    private function getNotificationData(User $user, Lesson $lesson): array
    {
        return [
            'user_from'     => $lesson->created_by,
            'user_to'       => $user->id,
            'full_message'  => '',
            'small_message' => $this->getSmallMessage($lesson),
            'component'     => Lesson::class,
            'data'          => $lesson->toJson(),
            'url'           => $this->getUrl($lesson),
            'time_created'  => Carbon::now()->toDateTimeString(),
        ];
    }

    /**
     * @param Lesson $lesson
     * @return string
     */
    private function getSmallMessage(Lesson $lesson): string
    {
        return 'Создано новое занятие (ID = ' . $lesson->id . ')';
    }

    /**
     * @param Lesson $lesson
     * @return string
     */
    private function getUrl(Lesson $lesson): string
    {
        return route('dashboard.lessons.edit', $lesson->id);
    }
}
