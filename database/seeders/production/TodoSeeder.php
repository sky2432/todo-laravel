<?php

namespace Database\Seeders\production;

use App\Models\TodoList;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TodoList::factory(700)->create();
    }
}
