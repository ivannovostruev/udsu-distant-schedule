<?php

namespace App\Providers;

use App\Models\Schedule\Lesson;
use App\Models\User;
use App\Support\Abilities\ColorAbilities;
use App\Support\Abilities\DashboardAbilities;
use App\Support\Abilities\GroupAbilities;
use App\Support\Abilities\LessonAbilities;
use App\Support\Abilities\ReasonAbilities;
use App\Support\Abilities\RoomAbilities;
use App\Support\Abilities\ScheduleAbilities;
use App\Support\Abilities\TeacherAbilities;
use App\Support\Abilities\TimeslotAbilities;
use App\Support\Abilities\UserAbilities;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $this->defineAdminGates();
        $this->defineAdminAndManagerAndCreatorGates();
        $this->defineOtherGates();
    }

    private function defineAdminGates(): void
    {
        $adminAbilities = [
            LessonAbilities::DESTROY,

            ColorAbilities::INDEX,
            ColorAbilities::CREATE,
            ColorAbilities::STORE,
            ColorAbilities::SHOW,
            ColorAbilities::EDIT,
            ColorAbilities::UPDATE,
            ColorAbilities::DESTROY,

            GroupAbilities::INDEX,
            GroupAbilities::CREATE,
            GroupAbilities::STORE,
            GroupAbilities::SHOW,
            GroupAbilities::EDIT,
            GroupAbilities::UPDATE,
            GroupAbilities::DESTROY,
            GroupAbilities::IMPORT,

            RoomAbilities::INDEX,
            RoomAbilities::CREATE,
            RoomAbilities::STORE,
            RoomAbilities::SHOW,
            RoomAbilities::EDIT,
            RoomAbilities::UPDATE,
            RoomAbilities::DESTROY,

            TeacherAbilities::INDEX,
            TeacherAbilities::CREATE,
            TeacherAbilities::STORE,
            TeacherAbilities::SHOW,
            TeacherAbilities::EDIT,
            TeacherAbilities::UPDATE,
            TeacherAbilities::DESTROY,
            TeacherAbilities::IMPORT,

            TimeslotAbilities::INDEX,
            TimeslotAbilities::CREATE,
            TimeslotAbilities::STORE,
            TimeslotAbilities::SHOW,
            TimeslotAbilities::EDIT,
            TimeslotAbilities::UPDATE,
            TimeslotAbilities::DESTROY,

            UserAbilities::INDEX,
            UserAbilities::CREATE,
            UserAbilities::STORE,
            UserAbilities::SHOW,
            UserAbilities::EDIT,
            UserAbilities::UPDATE,
            UserAbilities::DESTROY,

            ReasonAbilities::INDEX,
            ReasonAbilities::CREATE,
            ReasonAbilities::STORE,
            ReasonAbilities::SHOW,
            ReasonAbilities::EDIT,
            ReasonAbilities::UPDATE,
            ReasonAbilities::DESTROY,

            DashboardAbilities::WIDGETS,
        ];

        foreach ($adminAbilities as $adminAbility) {
            Gate::define($adminAbility, function (User $user) {
                return $user->isAdmin();
            });
        }
    }

    private function defineAdminAndManagerAndCreatorGates(): void
    {
        $adminOrManagerOrCreatorAbilities = [
            ScheduleAbilities::INDEX,
            DashboardAbilities::INDEX,

            LessonAbilities::INDEX,
            LessonAbilities::CREATE,
            LessonAbilities::STORE,
            LessonAbilities::SHOW,
        ];
        foreach ($adminOrManagerOrCreatorAbilities as $ability) {
            Gate::define($ability, function (User $user) {
                return $user->isAdminOrManagerOrCreator();
            });
        }
    }

    private function defineOtherGates()
    {
        Gate::define(LessonAbilities::EDIT, function(User $user, Lesson $lesson) {
            return $user->isLessonEditor($lesson);
        });
        Gate::define(LessonAbilities::UPDATE, function(User $user, Lesson $lesson) {
            return $user->isLessonEditor($lesson);
        });

        Gate::define(LessonAbilities::SHOW_ADMIN_OPTION, function (User $user) {
            return $user->isAdminOrManager();
        });
        Gate::define(LessonAbilities::APPROVE, function (User $user, Lesson $lesson) {
            return $user->isAdminOrManager();
        });
    }
}
