<?php

use Illuminate\Database\Seeder;

class TeamsSportSeed extends Seeder
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
                '_team_id' => 1,
                '_sport_id' => 1,
            ],
            [
                '_team_id' => 2,
                '_sport_id' => 1,
            ],
            [
                '_team_id' => 3,
                '_sport_id' => 1,
            ],
            [
                '_team_id' => 4,
                '_sport_id' => 1,
            ],
            [
                '_team_id' => 5,
                '_sport_id' => 2,
            ],
            [
                '_team_id' => 6,
                '_sport_id' => 2,
            ],
            [
                '_team_id' => 7,
                '_sport_id' => 2,
            ],
            [
                '_team_id' => 8,
                '_sport_id' => 3,
            ],
            [
                '_team_id' => 9,
                '_sport_id' => 3,
            ],
            [
                '_team_id' => 10,
                '_sport_id' => 3,
            ],
        ];

        foreach ($items as $item) {

            $team = \App\Team::find($item['_team_id']);
            $team->sports()->attach($item['_sport_id']);

        }
    }
}
