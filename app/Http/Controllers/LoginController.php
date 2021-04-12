<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $item = User::where('email', $request->email)->first();
        if (Hash::check($request->password, $item->password)) {
            return response()->json([
                'auth' => true,
                'data' => $item,
            ], 200);
        } else {
            return response()->json(['auth' => false], 200);
        }
    }

    public function confirm(Request $request)
    {
        $request->validate([
            'email' => 'required|email:rfc,dns|exists:users',
            'password' => 'required|min:4',
        ]);
        
        return response()->json([
                'message' => 'Validate OK',
            ], 200);
    }


}
