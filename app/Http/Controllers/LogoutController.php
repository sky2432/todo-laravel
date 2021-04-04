<?php

namespace App\Http\Controllers;

class LogoutController extends Controller
{
    public function __invoke() {
        return response()->json([
                'auth' => false,
            ], 200);
    }
}
