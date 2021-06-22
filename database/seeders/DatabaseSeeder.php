<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    const local = [
        local\UserSeeder::class,
        local\TodoSeeder::class,
    ];

    const production = [
        production\UserSeeder::class,
        production\TodoSeeder::class,
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment('local')) {
            $this->call(self::local);
        } elseif (App::environment('production')) {
            $this->call(self::production);
        }
    }
}
