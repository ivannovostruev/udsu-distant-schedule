<?php

namespace Database\Factories\Schedule;

use App\Models\Schedule\Reason;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReasonFactory extends Factory
{
    protected $model = Reason::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(rand(3, 6)),
            'type' => rand(1, 2),
        ];
    }
}
