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
            'name' => 'そら',
            'email' => 'test1@test.com',
            'password' => Hash::make('password'),
            'file_path' => config('data.defaultImage'),
            'created_at' => now(),
            'updated_at'=> now(),
            ],
            [
            'name' => 'すい',
            'email' => 'test2@test.com',
            'password' => Hash::make('password'),
            'file_path' => config('data.defaultImage'),
            'created_at' => now(),
            'updated_at'=> now(),
            ]
        ]);
    }
}
