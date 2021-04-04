<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormValidateController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:App\Models\User,name|min:2',
            'email' => 'required|email:rfc,dns|unique:App\Models\User,email',
            'password' => 'required|min:4',
        ]);

        return response()->json([
            'message' => 'Validate OK',
        ]);
    }
}
