<?php

namespace Database\Seeders\production;

use App\Models\User;
use Illuminate\Database\Seeder;
<<<<<<< HEAD
use Illuminate\Support\Facades\Hash;
=======
>>>>>>> 05ae81cc0df8520fb0a50a29e63254327733f836

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
<<<<<<< HEAD
            'password' => Hash::make(config('data.ADMIN_PASSWORD')),
=======

>>>>>>> 05ae81cc0df8520fb0a50a29e63254327733f836
            'role' => 'guest',
            'api_token' => 1234,
        ]);
    }
}
