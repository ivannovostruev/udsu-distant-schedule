<?php

namespace Database\Seeders;

use App\Models\Schedule\Color;
use Illuminate\Database\Seeder;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Color::factory(5)->create();
    }
}
