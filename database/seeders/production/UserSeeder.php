<?php

namespace Database\Seeders\production;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


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
            'password' => Hash::make(config('data.ADMIN_PASSWORD')),
            'role' => 'guest',
            'api_token' => 1234,
        ]);
    }
}
