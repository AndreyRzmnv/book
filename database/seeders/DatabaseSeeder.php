<?php

namespace Database\Seeders;

use Database\Seeders\Dialog\DialogMessagesTableSeeder;
use Database\Seeders\Dialog\DialogsTableSeeder;
use Database\Seeders\Users\RolesTableSeeder;
use Database\Seeders\Users\UsersTableSeeder;
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
        $this->call([
            // DialogsTableSeeder::class
            // DialogMessagesTableSeeder::class
            // RolesTableSeeder::class,
            // UsersTableSeeder::class,
        ]);
    }
}
