<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserFactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::today();
        $now->subYear();

        DB::table('users')->insert([
            [
            'name' => 'admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('1234'),
            'file_path' => config('data.DEFAULT_IMAGE1'),
            'role' => 'admin',
            'created_at' => $now,
            'updated_at'=> $now,
            ],
            [
            'name' => 'そら',
            'email' => 'test1@test.com',
            'password' => Hash::make('1234'),
            // 'file_path' => config('data.DEFAULT_IMAGE2'),
            'file_path' => 'defaultImage23.jpg',
            'role' => 'user',
            'created_at' => $now,
            'updated_at'=> $now,
            ],
            [
            'name' => 'すい',
            'email' => 'test2@test.com',
            'password' => Hash::make('1234'),
            // 'file_path' => config('data.DEFAULT_IMAGE3'),
            'file_path' => 'defaultImage24.jpg',
            'role' => 'user',
            'created_at' => $now,
            'updated_at'=> $now,
            ],
        ]);
        User::factory()->count(20)->create();
    }
}
