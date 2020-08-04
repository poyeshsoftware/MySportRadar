<?php

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
        $this->call(Userseed::class);
        $this->call(SportsSeed::class);
        $this->call(TeamsSeed::class);
        $this->call(TeamsSportSeed::class);
        $this->call(EventSeed::class);
    }
}
