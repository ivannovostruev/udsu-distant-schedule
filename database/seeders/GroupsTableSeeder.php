<?php

namespace Database\Seeders;

use App\Models\Schedule\Group;
use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::factory(10)->create();
    }
}
