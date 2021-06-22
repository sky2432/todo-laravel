<?php

namespace Database\Seeders\local;

use App\Models\User;
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
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'ゲスト',
            'email' => 'guest@user.com',
            'role' => 'guest',
            'api_token' => 1234,
        ]);

        User::factory()->create([
            'name' => 'そら',
            'email' => 'test1@test.com',
            'role' => 'user',
        ]);

        User::factory()->create([
            'name' => 'すい',
            'email' => 'test2@test.com',
            'role' => 'user',
        ]);

        User::factory()->count(13)->create();
    }
}
