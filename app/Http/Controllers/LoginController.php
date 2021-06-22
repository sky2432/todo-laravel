<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function confirm(Request $request)
    {
        $item = User::where('email', $request->email)->first();

        $request->validate([
            'email' => ['required','email','exists:users',
        ],
            'password' => ['required',
                function ($attribute, $value, $fail) use ($item) {
                    if ($item && !(Hash::check($value, $item->password))) {
                        return $fail('パスワードが間違っています。');
                    }
                },
            ]
        ]);

        return response()->json([
                'message' => 'Validate OK',
            ], 200);
    }

    public function login(Request $request)
    {
        $item = User::where('email', $request->email)->first();
        if (Hash::check($request->password, $item->password)) {
            if ($item->role === 'guest') {
                $token = $item->api_token;
            } else {
                $token = Str::random(60);
                $item->api_token = $token;
                $item->save();
            }

            return response()->json([
                'auth' => true,
                'token' => $token,
                'data' => $item,
            ], 200);
        } else {
            return response()->json(['auth' => false], 200);
        }
    }
}
