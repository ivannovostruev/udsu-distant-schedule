<?php

namespace Database\Factories\Schedule;

use App\Models\Schedule\Color;
use App\Models\Schedule\Lesson;
use App\Models\Schedule\Room;
use App\Models\Schedule\Teacher;
use App\Models\Schedule\Timeslot;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    protected $model = Lesson::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'                  => $this->faker->sentence(rand(3, 6)),
            'date'                  => $this->faker->dateTimeBetween('-2 days', '+2 days'),
            'teacher_id'            => rand(1, Teacher::max('id')),
            'education_level'       => rand(1, 7),
            'type'                  => rand(1, 9),
            'system_type'           => rand(1, 3),
            'link_type'             => rand(1, 2),
            'location'              => rand(1, 4),
            'commentary'            => $this->faker->realText(rand(50, 100)),
            'should_record'         => rand(0, 1),
            'special_requirements'  => array_unique([rand(1, 3), rand(1,3)]),
            'timeslot_id'           => rand(1, Timeslot::max('id')),
            'color_id'              => rand(1, Color::max('id')),
            'room_id'               => rand(1, Room::max('id')),
            'status'                => 3,
            'created_by'            => rand(1, User::max('id')),
        ];
    }
}
