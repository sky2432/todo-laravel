<?php

namespace Database\Factories;

use App\Models\TodoList;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class TodoListFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TodoList::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $deadline = $this->faker->randomElement([null, $this->faker->dateTimeBetween('-1week', '1month')->format('Y-m-d')], );

        if ($deadline === null) {
            $remind_day = null;
            $remind_time = null;
        } else {
            $remind_day = rand(0, 2);
            $remind_time = $this->faker->time('H:00:00');
        }

        $status = $this->faker->randomElement([true, false, false, false, false, false, false, false, false, false]);

        if ($status === true) {
            $done_at = null;
        }
        if ($status === false) {
            $done_at = $this->faker->dateTimeBetween('-1year', 'now')->format('Y-m-d H:i:s');
        }

        $todoLists = [
            '学習',
            '勉強',
            '課題',
            'レポート',
            '書類提出',
            'メルカリ',
            '調べ物',
            'メール',
            '買い物',
            '掃除',
            '片付け',
            '振り込み',
            '公共料金',
            'ゴミ出し',
            'ミーティング',
            '資料作成',
            'プログラミング',
            '長いTodoです。長いTodoです。',
        ];

        return [
            'user_id' => User::whereNotIn('role', ['admin'])->pluck('id')->random(),
            'todo_list' => Arr::random($todoLists),
            'deadline' => $deadline,
            'remind_day' => $remind_day,
            'remind_time' => $remind_time,
            'status' => $status,
            'done_at' => $done_at,
        ];
    }
}
