<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function post(Request $request)
    {
        $item = new User();
        $item->fill($request->all());

        $hashed_password = Hash::make($request->password);

        $item->password = $hashed_password;
        $item->file_path = config('data.defaultImage');
        $item->save();

        return response()->json([
            'message' => 'User created successfully',
            'data' => $item
        ], 200);
    }
}
