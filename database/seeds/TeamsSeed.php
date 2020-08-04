<?php

use Illuminate\Database\Seeder;

class TeamsSeed extends Seeder
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
                'id' => 1,
                'name' => 'Bayern Munich',
            ],
            [
                'id' => 2,
                'name' => 'Manchester City',
            ],
            [
                'id' => 3,
                'name' => 'Barcelona',
            ],
            [
                'id' => 4,
                'name' => 'Real Madrid',
            ],
            [
                'id' => 5,
                'name' => 'Boston Celtics',
            ],
            [
                'id' => 6,
                'name' => 'Chicago Bulls',
            ],
            [
                'id' => 7,
                'name' => 'Houston Rockets',
            ],
            [
                'id' => 8,
                'name' => 'New York Empire',
            ],
            [
                'id' => 9,
                'name' => 'Orange County Breakers',
            ],
            [
                'id' => 10,
                'name' => 'Chicago Smash',
            ],
        ];

        foreach ($items as $item) {
            \App\Team::create($item);
        }
    }
}
