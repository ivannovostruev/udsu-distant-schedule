<?php

namespace App\Providers;

use App\DataCollectors\ColorDataCollector;
use App\DataCollectors\GroupDataCollector;
use App\DataCollectors\LessonDataCollector;
use App\DataCollectors\ReasonDataCollector;
use App\DataCollectors\RoomDataCollector;
use App\DataCollectors\TeacherDataCollector;
use App\DataCollectors\TimeslotDataCollector;
use App\DataCollectors\UserDataCollector;
use App\Repositories\BaseRepository;
use App\Repositories\ColorRepository;
use App\Repositories\GroupRepository;
use App\Repositories\LessonRepository;
use App\Repositories\ReasonRepository;
use App\Repositories\RoomRepository;
use App\Repositories\TeacherRepository;
use App\Repositories\TimeslotRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class DataCollectorsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(ColorDataCollector::class)
            ->needs(BaseRepository::class)
            ->give(ColorRepository::class);

        $this->app->when(GroupDataCollector::class)
            ->needs(BaseRepository::class)
            ->give(GroupRepository::class);

        $this->app->when(LessonDataCollector::class)
            ->needs(BaseRepository::class)
            ->give(LessonRepository::class);

        $this->app->when(ReasonDataCollector::class)
            ->needs(BaseRepository::class)
            ->give(ReasonRepository::class);

        $this->app->when(RoomDataCollector::class)
            ->needs(BaseRepository::class)
            ->give(RoomRepository::class);

        $this->app->when(TeacherDataCollector::class)
            ->needs(BaseRepository::class)
            ->give(TeacherRepository::class);

        $this->app->when(TimeslotDataCollector::class)
            ->needs(BaseRepository::class)
            ->give(TimeslotRepository::class);

        $this->app->when(UserDataCollector::class)
            ->needs(BaseRepository::class)
            ->give(UserRepository::class);
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
