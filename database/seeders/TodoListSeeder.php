<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TodoListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('todo_lists')->insert([
            [
            'member_id' => 1,
            'todo_list' => '読書',
            'created_at' => now(),
            ],
            [
            'member_id' => 2,
            'todo_list' => '部屋の片付け',
            'created_at' => now(),
            ],
            [
            'member_id' => 1,
            'todo_list' => '洗濯',
            'created_at' => now(),
            ],
            [
            'member_id' => 2,
            'todo_list' => '買い物',
            'created_at' => now(),
            ],
        ]);
    }
}
