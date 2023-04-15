<?php

namespace Database\Factories\Schedule;

use App\Models\Schedule\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    protected $model = Teacher::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'full_name'     => $this->faker->name(),
            'email'         => $this->faker->unique()->safeEmail(),
            'description'   => $this->faker->realText(rand(30, 100)),
        ];
    }
}
