<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Provider\DateTime;


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

        $lists = [
            [
            'user_id' => 2,
            'todo_list' => '読書',
            'remind_day' => 0,
            'remind_time' => '09:00:00',
            'status' => false,
            'done_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'deadline' => $yesterday,
            ],
            [
            'user_id' => 2,
            'todo_list' => '部屋の片付け',
            'remind_day' => 0,
            'remind_time' => '09:00:00',
            'status' => false,
            'done_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
            'deadline' => $yesterday,
            ],
            [
            'user_id' => 2,
            'todo_list' => '洗濯',
            'remind_day' => 0,
            'remind_time' => '09:00:00',
            'status' => true,
            'done_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
            'deadline' => $yesterday,
            ],
            [
            'user_id' => 2,
            'todo_list' => '課題',
            'remind_day' => 0,
            'remind_time' => '09:00:00',
            'status' => true,
            'done_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
            'deadline' => $yesterday,
            ],
            [
            'user_id' => 2,
            'todo_list' => '勉強',
            'remind_day' => 0,
            'remind_time' => '09:00:00',
            'status' => true,
            'done_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
            'deadline' => $yesterday,
            ],
            [
            'user_id' => 2,
            'todo_list' => '掃除',
            'remind_day' => 0,
            'remind_time' => '09:00:00',
            'status' => true,
            'done_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
            'deadline' => $today,
            ],
            [
            'user_id' => 2,
            'todo_list' => '運動',
            'remind_day' => 0,
            'remind_time' => '09:00:00',
            'status' => true,
            'done_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
            'deadline' => $today,
            ],
            [
            'user_id' => 2,
            'todo_list' => '勉強',
            'deadline' => $today,
            'remind_day' => 0,
            'remind_time' => '09:00:00',
            'status' => true,
            'done_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ],
            [
            'user_id' => 2,
            'todo_list' => '長いTodoです。長いTodoです。長いTodoです。長いTodoです。長いTodoです。長いTodoです。',
            'remind_day' => 0,
            'remind_time' => '09:00:00',
            'status' => true,
            'done_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
            'deadline' => $today,
            ],
            [
            'user_id' => 3,
            'todo_list' => '買い物',
            'remind_day' => 0,
            'remind_time' => '09:00:00',
            'status' => true,
            'done_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
            'deadline' => $yesterday,

            ],
            [
            'user_id' => 3,
            'todo_list' => '支払い',
            'remind_day' => 0,
            'remind_time' => '09:00:00',
            'status' => true,
            'done_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
            'deadline' => $today,

            ],
            [
            'user_id' => 3,
            'todo_list' => '書類整理',
            'remind_day' => 0,
            'remind_time' => '09:00:00',
            'status' => true,
            'done_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
            'deadline' => $today,

            ],
        ];

        foreach ($lists as $list) {
            DB::table('todo_lists')->insert([
                'id' => $list['id'],
                'name' => $list['name'],
                'email' => $list['email'],
                'created_at' => DateTime::dateTimeThisDecade(), // 追加
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
