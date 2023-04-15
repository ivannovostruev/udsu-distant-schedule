<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rooms = [];
        for ($i = 1; $i <= 12; $i++) {
            $rooms[] = [
                'name' => $i,
                'created_at' => now(),
            ];
        }

        DB::table('rooms')->insert($rooms);
    }
}
