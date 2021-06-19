<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@test.com',
            'file_path' => config('data.DEFAULT_IMAGE1'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'ゲスト',
            'email' => 'guest@guest.com',
            'file_path' => 'defaultImage21.jpg',
            'role' => 'guest',
            'api_token' => 1234,
        ]);

        User::factory()->create([
            'name' => 'そら',
            'email' => 'test1@test.com',
            'file_path' => config('data.DEFAULT_IMAGE2'),
            'role' => 'user',
        ]);

        User::factory()->create([
            'name' => 'すい',
            'email' => 'test2@test.com',
            'file_path' => config('data.DEFAULT_IMAGE3'),
            'role' => 'user',
        ]);

        User::factory()->count(13)->create();
    }
}
