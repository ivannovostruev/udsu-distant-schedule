<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'Admin',
                'description' => '',
            ],
            [
                'name' => 'Manager',
                'description' => '',
            ],
            [
                'name' => 'Creator',
                'description' => '',
            ],
        ];

        DB::table('roles')->insert($roles);
    }
}
