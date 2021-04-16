<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserFactorySeeder::class,
            TodoFactorySeeder::class,
            // UserSeeder::class,
            // UserSeeder2::class,
            // TodoListSeeder::class,
        ]);
    }
}
