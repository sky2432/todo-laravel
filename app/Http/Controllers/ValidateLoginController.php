<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ValidateLoginController extends Controller
{
    public function __invoke(Request $request)
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
