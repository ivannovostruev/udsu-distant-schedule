<?php

namespace App\Providers;

use App\Support\Abilities\Abilities;
use App\Support\Abilities\ColorAbilities;
use App\Support\Abilities\GroupAbilities;
use App\Support\Abilities\LessonAbilities;
use App\Support\Abilities\ReasonAbilities;
use App\Support\Abilities\RoomAbilities;
use App\Support\Abilities\TeacherAbilities;
use App\Support\Abilities\TimeslotAbilities;
use App\Support\Abilities\UserAbilities;
use App\Support\ModelManagers\ColorModelManager;
use App\Support\ModelManagers\GroupModelManager;
use App\Support\ModelManagers\LessonModelManager;
use App\Support\ModelManagers\ReasonModelManager;
use App\Support\ModelManagers\RoomModelManager;
use App\Support\ModelManagers\TeacherModelManager;
use App\Support\ModelManagers\TimeslotModelManager;
use App\Support\ModelManagers\UserModelManager;
use App\Support\Pages\ColorPage;
use App\Support\Pages\GroupPage;
use App\Support\Pages\LessonPage;
use App\Support\Pages\Page;
use App\Support\Pages\ReasonPage;
use App\Support\Pages\RoomsPage;
use App\Support\Pages\TeacherPage;
use App\Support\Pages\TimeslotPage;
use App\Support\Pages\UserPage;
use App\Support\RouteNames\ColorRouteNames;
use App\Support\RouteNames\GroupRouteNames;
use App\Support\RouteNames\LessonRouteNames;
use App\Support\RouteNames\ReasonRouteNames;
use App\Support\RouteNames\RoomRouteNames;
use App\Support\RouteNames\RouteNames;
use App\Support\RouteNames\TeacherRouteNames;
use App\Support\RouteNames\TimeslotRouteNames;
use App\Support\RouteNames\UserRouteNames;
use App\Support\ViewNames\ColorViewNames;
use App\Support\ViewNames\GroupViewNames;
use App\Support\ViewNames\LessonViewNames;
use App\Support\ViewNames\ReasonViewNames;
use App\Support\ViewNames\RoomViewNames;
use App\Support\ViewNames\TeacherViewNames;
use App\Support\ViewNames\TimeslotViewNames;
use App\Support\ViewNames\UserViewNames;
use App\Support\ViewNames\ViewNames;
use Illuminate\Support\ServiceProvider;

class ModelManagerServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(ColorModelManager::class)
            ->needs(Abilities::class)
            ->give(ColorAbilities::class);

        $this->app->when(ColorModelManager::class)
            ->needs(RouteNames::class)
            ->give(ColorRouteNames::class);

        $this->app->when(ColorModelManager::class)
            ->needs(ViewNames::class)
            ->give(ColorViewNames::class);

        $this->app->when(ColorModelManager::class)
            ->needs(Page::class)
            ->give(ColorPage::class);



        $this->app->when(GroupModelManager::class)
            ->needs(Abilities::class)
            ->give(GroupAbilities::class);

        $this->app->when(GroupModelManager::class)
            ->needs(RouteNames::class)
            ->give(GroupRouteNames::class);

        $this->app->when(GroupModelManager::class)
            ->needs(ViewNames::class)
            ->give(GroupViewNames::class);

        $this->app->when(GroupModelManager::class)
            ->needs(Page::class)
            ->give(GroupPage::class);



        $this->app->when(LessonModelManager::class)
            ->needs(Abilities::class)
            ->give(LessonAbilities::class);

        $this->app->when(LessonModelManager::class)
            ->needs(RouteNames::class)
            ->give(LessonRouteNames::class);

        $this->app->when(LessonModelManager::class)
            ->needs(ViewNames::class)
            ->give(LessonViewNames::class);

        $this->app->when(LessonModelManager::class)
            ->needs(Page::class)
            ->give(LessonPage::class);



        $this->app->when(ReasonModelManager::class)
            ->needs(Abilities::class)
            ->give(ReasonAbilities::class);

        $this->app->when(ReasonModelManager::class)
            ->needs(RouteNames::class)
            ->give(ReasonRouteNames::class);

        $this->app->when(ReasonModelManager::class)
            ->needs(ViewNames::class)
            ->give(ReasonViewNames::class);

        $this->app->when(ReasonModelManager::class)
            ->needs(Page::class)
            ->give(ReasonPage::class);



        $this->app->when(RoomModelManager::class)
            ->needs(Abilities::class)
            ->give(RoomAbilities::class);

        $this->app->when(RoomModelManager::class)
            ->needs(RouteNames::class)
            ->give(RoomRouteNames::class);

        $this->app->when(RoomModelManager::class)
            ->needs(ViewNames::class)
            ->give(RoomViewNames::class);

        $this->app->when(RoomModelManager::class)
            ->needs(Page::class)
            ->give(RoomsPage::class);



        $this->app->when(TeacherModelManager::class)
            ->needs(Abilities::class)
            ->give(TeacherAbilities::class);

        $this->app->when(TeacherModelManager::class)
            ->needs(RouteNames::class)
            ->give(TeacherRouteNames::class);

        $this->app->when(TeacherModelManager::class)
            ->needs(ViewNames::class)
            ->give(TeacherViewNames::class);

        $this->app->when(TeacherModelManager::class)
            ->needs(Page::class)
            ->give(TeacherPage::class);



        $this->app->when(TimeslotModelManager::class)
            ->needs(Abilities::class)
            ->give(TimeslotAbilities::class);

        $this->app->when(TimeslotModelManager::class)
            ->needs(RouteNames::class)
            ->give(TimeslotRouteNames::class);

        $this->app->when(TimeslotModelManager::class)
            ->needs(ViewNames::class)
            ->give(TimeslotViewNames::class);

        $this->app->when(TimeslotModelManager::class)
            ->needs(Page::class)
            ->give(TimeslotPage::class);



        $this->app->when(UserModelManager::class)
            ->needs(Abilities::class)
            ->give(UserAbilities::class);

        $this->app->when(UserModelManager::class)
            ->needs(RouteNames::class)
            ->give(UserRouteNames::class);

        $this->app->when(UserModelManager::class)
            ->needs(ViewNames::class)
            ->give(UserViewNames::class);

        $this->app->when(UserModelManager::class)
            ->needs(Page::class)
            ->give(UserPage::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
