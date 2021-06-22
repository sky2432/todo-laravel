<?php

namespace Database\Seeders\production;

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
            'password' => config('data.ADMIN_PASSWORD'),
            'role' => 'guest',
            'api_token' => 1234,
        ]);
    }
}
