<?php

namespace App\Providers;

use App\DataCollectors\ColorDataCollector;
use App\DataCollectors\DataCollector;
use App\DataCollectors\GroupDataCollector;
use App\DataCollectors\LessonDataCollector;
use App\DataCollectors\ReasonDataCollector;
use App\DataCollectors\RoomDataCollector;
use App\DataCollectors\TeacherDataCollector;
use App\DataCollectors\TimeslotDataCollector;
use App\DataCollectors\UserDataCollector;
use App\Http\Controllers\Dashboard\ColorController;
use App\Http\Controllers\Dashboard\GroupController;
use App\Http\Controllers\Dashboard\LessonController;
use App\Http\Controllers\Dashboard\ReasonController;
use App\Http\Controllers\Dashboard\RoomController;
use App\Http\Controllers\Dashboard\TeacherController;
use App\Http\Controllers\Dashboard\TimeslotController;
use App\Http\Controllers\Dashboard\UserController;
use App\ModelServices\ColorService;
use App\ModelServices\GroupService;
use App\ModelServices\LessonService;
use App\ModelServices\ModelService;
use App\ModelServices\ReasonService;
use App\ModelServices\RoomService;
use App\ModelServices\TeacherService;
use App\ModelServices\TimeslotService;
use App\ModelServices\UserService;
use App\Repositories\BaseRepository;
use App\Repositories\ColorRepository;
use App\Repositories\GroupRepository;
use App\Repositories\LessonRepository;
use App\Repositories\ReasonRepository;
use App\Repositories\RoomRepository;
use App\Repositories\TeacherRepository;
use App\Repositories\TimeslotRepository;
use App\Repositories\UserRepository;
use App\Support\ModelManagers\ColorModelManager;
use App\Support\ModelManagers\GroupModelManager;
use App\Support\ModelManagers\LessonModelManager;
use App\Support\ModelManagers\ModelManager;
use App\Support\ModelManagers\ReasonModelManager;
use App\Support\ModelManagers\RoomModelManager;
use App\Support\ModelManagers\TeacherModelManager;
use App\Support\ModelManagers\TimeslotModelManager;
use App\Support\ModelManagers\UserModelManager;
use Illuminate\Support\ServiceProvider;

class DashboardControllersServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(ColorController::class)
            ->needs(BaseRepository::class)
            ->give(ColorRepository::class);

        $this->app->when(ColorController::class)
            ->needs(DataCollector::class)
            ->give(ColorDataCollector::class);

        $this->app->when(ColorController::class)
            ->needs(ModelService::class)
            ->give(ColorService::class);

        $this->app->when(ColorController::class)
            ->needs(ModelManager::class)
            ->give(ColorModelManager::class);

        $this->app->when(GroupController::class)
            ->needs(BaseRepository::class)
            ->give(GroupRepository::class);

        $this->app->when(GroupController::class)
            ->needs(DataCollector::class)
            ->give(GroupDataCollector::class);

        $this->app->when(GroupController::class)
            ->needs(ModelService::class)
            ->give(GroupService::class);

        $this->app->when(GroupController::class)
            ->needs(ModelManager::class)
            ->give(GroupModelManager::class);

        $this->app->when(LessonController::class)
            ->needs(BaseRepository::class)
            ->give(LessonRepository::class);

        $this->app->when(LessonController::class)
            ->needs(DataCollector::class)
            ->give(LessonDataCollector::class);

        $this->app->when(LessonController::class)
            ->needs(ModelService::class)
            ->give(LessonService::class);

        $this->app->when(LessonController::class)
            ->needs(ModelManager::class)
            ->give(LessonModelManager::class);

        $this->app->when(ReasonController::class)
            ->needs(BaseRepository::class)
            ->give(ReasonRepository::class);

        $this->app->when(ReasonController::class)
            ->needs(DataCollector::class)
            ->give(ReasonDataCollector::class);

        $this->app->when(ReasonController::class)
            ->needs(ModelService::class)
            ->give(ReasonService::class);

        $this->app->when(ReasonController::class)
            ->needs(ModelManager::class)
            ->give(ReasonModelManager::class);

        $this->app->when(RoomController::class)
            ->needs(BaseRepository::class)
            ->give(RoomRepository::class);

        $this->app->when(RoomController::class)
            ->needs(DataCollector::class)
            ->give(RoomDataCollector::class);

        $this->app->when(RoomController::class)
            ->needs(ModelService::class)
            ->give(RoomService::class);

        $this->app->when(RoomController::class)
            ->needs(ModelManager::class)
            ->give(RoomModelManager::class);

        $this->app->when(TeacherController::class)
            ->needs(BaseRepository::class)
            ->give(TeacherRepository::class);

        $this->app->when(TeacherController::class)
            ->needs(DataCollector::class)
            ->give(TeacherDataCollector::class);

        $this->app->when(TeacherController::class)
            ->needs(ModelService::class)
            ->give(TeacherService::class);

        $this->app->when(TeacherController::class)
            ->needs(ModelManager::class)
            ->give(TeacherModelManager::class);

        $this->app->when(TimeslotController::class)
            ->needs(BaseRepository::class)
            ->give(TimeslotRepository::class);

        $this->app->when(TimeslotController::class)
            ->needs(DataCollector::class)
            ->give(TimeslotDataCollector::class);

        $this->app->when(TimeslotController::class)
            ->needs(ModelService::class)
            ->give(TimeslotService::class);

        $this->app->when(TimeslotController::class)
            ->needs(ModelManager::class)
            ->give(TimeslotModelManager::class);

        $this->app->when(UserController::class)
            ->needs(BaseRepository::class)
            ->give(UserRepository::class);

        $this->app->when(UserController::class)
            ->needs(DataCollector::class)
            ->give(UserDataCollector::class);

        $this->app->when(UserController::class)
            ->needs(ModelService::class)
            ->give(UserService::class);

        $this->app->when(UserController::class)
            ->needs(ModelManager::class)
            ->give(UserModelManager::class);
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
