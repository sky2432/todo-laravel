<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        //
        DB::table('users')->insert([
            [
            'name' => 'admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
            'file_path' => config('data.DEFAULT_IMAGE1'),
            // 'phone_number' => null,
            'role' => 'admin',
            'created_at' => now(),
            'updated_at'=> now(),
            ],
            [
            'name' => 'そら',
            'email' => 'test1@test.com',
            'password' => Hash::make('password'),
            'file_path' => config('data.DEFAULT_IMAGE2'),
            // 'phone_number' => null,
            'role' => 'user',
            'created_at' => now(),
            'updated_at'=> now(),
            ],
            [
            'name' => 'すい',
            'email' => 'test2@test.com',
            'password' => Hash::make('password'),
            'file_path' => config('data.DEFAULT_IMAGE3'),
            // 'phone_number' => null,
            'role' => 'user',
            'created_at' => now(),
            'updated_at'=> now(),
            ],
            [
            'name' => 'すい',
            'email' => 'test3@test.com',
            'password' => Hash::make('password'),
            'file_path' => config('data.DEFAULT_IMAGE3'),
            // 'phone_number' => null,
            'role' => 'user',
            'created_at' => now(),
            'updated_at'=> now(),
            ],
            [
            'name' => 'すい',
            'email' => 'test4@test.com',
            'password' => Hash::make('password'),
            'file_path' => config('data.DEFAULT_IMAGE3'),
            // 'phone_number' => null,
            'role' => 'user',
            'created_at' => now(),
            'updated_at'=> now(),
            ],
            [
            'name' => 'すい',
            'email' => 'test5@test.com',
            'password' => Hash::make('password'),
            'file_path' => config('data.DEFAULT_IMAGE3'),
            // 'phone_number' => null,
            'role' => 'user',
            'created_at' => now(),
            'updated_at'=> now(),
            ],
            [
            'name' => 'すい',
            'email' => 'test6@test.com',
            'password' => Hash::make('password'),
            'file_path' => config('data.DEFAULT_IMAGE3'),
            // 'phone_number' => null,
            'role' => 'user',
            'created_at' => now(),
            'updated_at'=> now(),
            ],
        ]);
    }
}
