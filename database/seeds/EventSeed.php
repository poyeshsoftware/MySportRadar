<?php

use Illuminate\Database\Seeder;

class EventSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'date' => '2020-08-05 12:00:00',
                '_team_id_1' => 1,
                '_team_id_2' => 2,
                '_sport_id' => 1,
            ],
            [
                'date' => '2020-08-05 18:30:00',
                '_team_id_1' => 3,
                '_team_id_2' => 4,
                '_sport_id' => 1,
            ],
            [
                'date' => '2020-08-06 15:30:00',
                '_team_id_1' => 5,
                '_team_id_2' => 6,
                '_sport_id' => 2,
            ],
            [
                'date' => '2020-08-07 11:30:00',
                '_team_id_1' => 6,
                '_team_id_2' => 7,
                '_sport_id' => 2,
            ],
            [
                'date' => '2020-08-10 16:30:00',
                '_team_id_1' => 8,
                '_team_id_2' => 9,
                '_sport_id' => 3,
            ],
            [
                'date' => '2020-08-12 12:30:00',
                '_team_id_1' => 10,
                '_team_id_2' => 9,
                '_sport_id' => 3,
            ],
        ];

        foreach ($items as $item) {
            \App\TheEvent::create($item);
        }
    }
}
