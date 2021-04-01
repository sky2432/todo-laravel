<?php

namespace App\Http\Controllers;

class LogoutController extends Controller
{
    public function post() {
        return response()->json([
                'auth' => false,
            ], 200);
    }
}
