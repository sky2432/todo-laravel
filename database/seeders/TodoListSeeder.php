<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\TodoList;

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
        $now = new Carbon();
        $today = $now->format('Y-m-d');
        
        $later = new Carbon();
        $later->subDay();
        $yesterday = $later->format('Y-m-d');

        DB::table('todo_lists')->insert([
            [
            'user_id' => 2,
            'todo_list' => '読書',
            'status' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'deadline' => $yesterday,
            ],
            [
            'user_id' => 2,
            'todo_list' => '部屋の片付け',
            'status' => false,
            'created_at' => now(),
            'updated_at' => now(),
            'deadline' => $yesterday,
            ],
            [
            'user_id' => 2,
            'todo_list' => '洗濯',
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
            'deadline' => $yesterday,
            ],
            [
            'user_id' => 2,
            'todo_list' => '課題',
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
            'deadline' => $today,
            ],
            [
            'user_id' => 2,
            'todo_list' => '勉強',
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
            'deadline' => $today,
            ],
            [
            'user_id' => 2,
            'todo_list' => '掃除',
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
            'deadline' => $today,
            ],
            [
            'user_id' => 2,
            'todo_list' => '運動',
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
            'deadline' => $today,
            ],
            [
            'user_id' => 2,
            'todo_list' => '勉強',
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
            'deadline' => $today,
            ],
            [
            'user_id' => 2,
            'todo_list' => '支払い',
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
            'deadline' => $today,
            ],
            [
            'user_id' => 3,
            'todo_list' => '買い物',
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
            'deadline' => $yesterday,

            ],
            [
            'user_id' => 3,
            'todo_list' => '支払い',
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
            'deadline' => $today,

            ],
            [
            'user_id' => 3,
            'todo_list' => '書類整理',
            'status' => true,
            'created_at' => now(),
            'updated_at' => now(),
            'deadline' => $today,

            ],
        ]);
    }
}
