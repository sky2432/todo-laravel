<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('members')->insert([
            [
            'name' => 'そら',
            'email' => 'test1@test.com',
            'password' => Hash::make('password'),
            'file_path' => null,
            'created_at' => now(),
            ],
            [
            'name' => 'すい',
            'email' => 'test2@test.com',
            'password' => Hash::make('password'),
            'file_path' => null,
            'created_at' => now(),
            ]
        ]);
    }
}
