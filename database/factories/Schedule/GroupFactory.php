<?php

namespace Database\Factories\Schedule;

use App\Models\Schedule\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    protected $model = Group::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $pattern = '[a-zA-Z]{2,4}-\d{2}\.\d{2}\.\d{2}-[1-6][1-9]';

        return [
            'name' => $this->faker->regexify($pattern),
        ];
    }
}
