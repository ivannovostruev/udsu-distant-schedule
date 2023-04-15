<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TimeslotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timeslots = [
            [
                'name'          => '1 пара',
                'start_time'    => '008:00:00',
                'end_time'      => '009:30:00',
            ],
            [
                'name'          => '2 пара',
                'start_time'    => '009:40:00',
                'end_time'      => '011:10:00',
            ],
            [
                'name'          => '3 пара',
                'start_time'    => '011:40:00',
                'end_time'      => '013:10:00',
            ],
            [
                'name'          => '4 пара',
                'start_time'    => '013:30:00',
                'end_time'      => '015:00:00',
            ],
            [
                'name'          => '5 пара',
                'start_time'    => '015:20:00',
                'end_time'      => '016:50:00',
            ],
            [
                'name'          => '6 пара',
                'start_time'    => '017:00:00',
                'end_time'      => '018:30:00',
            ],
            [
                'name'          => '7 пара',
                'start_time'    => '018:40:00',
                'end_time'      => '020:10:00',
            ],
            [
                'name'          => '8 пара',
                'start_time'    => '020:20:00',
                'end_time'      => '021:50:00',
            ],
        ];

        foreach ($timeslots as &$timeslot) {
            $timeslot['created_at'] = now();
        }

        DB::table('timeslots')->insert($timeslots);
    }
}
