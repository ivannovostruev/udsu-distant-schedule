<?php

namespace Database\Seeders;

use App\Models\Schedule\Teacher;
use Illuminate\Database\Seeder;

class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Teacher::factory(10)->create();
    }
}
