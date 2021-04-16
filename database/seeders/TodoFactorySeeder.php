<?php

namespace Database\Seeders;

use App\Models\TodoList;
use Illuminate\Database\Seeder;

class TodoFactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TodoList::factory()->count(10000)->create();
    }
}
