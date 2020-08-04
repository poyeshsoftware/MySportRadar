<?php

use Illuminate\Database\Seeder;

class SportsSeed extends Seeder
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
                'name' => 'Football',
            ],
            [
                'id' => 2,
                'name' => 'Basketball',
            ],
            [
                'id' => 3,
                'name' => 'Tennis',
            ],

        ];

        foreach ($items as $item) {
            \App\Sport::create($item);
        }
    }
}
