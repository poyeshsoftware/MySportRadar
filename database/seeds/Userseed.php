<?php

use Illuminate\Database\Seeder;

class Userseed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [

            ['id' => 1,
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin'),
                'remember_token' => '',],
        ];

        foreach ($items as $item) {
            \App\User::create($item);
        }
    }



}
