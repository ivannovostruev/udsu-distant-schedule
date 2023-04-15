<?php

namespace Database\Seeders;

use App\Models\Schedule\Group;
use App\Models\Schedule\Lesson;
use App\Models\Schedule\Reason;
use Illuminate\Database\Seeder;

class LessonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lesson::factory(40)->create();

        foreach (Lesson::all() as $lesson) {
            $groups = Group::inRandomOrder()->take(rand(1,4))->pluck('id');
            $reasons = Reason::inRandomOrder()->take(rand(1,4))->pluck('id');
            $lesson->groups()->attach($groups);
            $lesson->reasons()->attach($reasons);
        }
    }
}
