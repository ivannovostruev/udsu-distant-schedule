<?php

namespace Database\Factories\Schedule;

use App\Models\Schedule\Color;
use Illuminate\Database\Eloquent\Factories\Factory;

class ColorFactory extends Factory
{
    protected $model = Color::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'hex'           => $this->faker->unique()->hexColor(),
            'description'   => $this->faker->realText(),
//            'weight'        => $this->faker->unique()->numerify('##'),
        ];
    }
}
