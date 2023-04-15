<?php

namespace Database\Seeders;

use App\Models\Schedule\Reason;
use Illuminate\Database\Seeder;

class ReasonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reason::factory(10)->create();
    }
}
