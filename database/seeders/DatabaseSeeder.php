<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
//        $this->call(ColorsTableSeeder::class);
//        $this->call(TeachersTableSeeder::class);
//        $this->call(RoomsTableSeeder::class);
//        $this->call(TimeslotsTableSeeder::class);
//        $this->call(GroupsTableSeeder::class);
//        $this->call(ReasonsTableSeeder::class);
//        $this->call(LessonsTableSeeder::class);
    }
}
