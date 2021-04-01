<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Mail;

class RegisterController extends Controller
{
    public function post(Request $request)
    {
        $now = Carbon::now();
        $hashed_password = Hash::make($request->password);
        $param = [
            "name" => $request->name,
            "email" => $request->email,
            "password" => $hashed_password,
            "file_path" => '猫.jpg',
            "created_at" => $now,
            "updated_at" => $now,
        ];
        DB::table('members')->insert($param);
        return response()->json([
            'message' => 'User created successfully',
            'data' => $param
        ], 200);
    }
}

