<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Member;

class LoginValidateController extends Controller
{
    //
    public function post(Request $request)
    {
        $errors = [];

        $item = DB::table('members')->where('email', $request->email)->first();

        if ($item) {
            if (Hash::check($request->password, $item->password)) {
            } else {
                $errors['password'] = 'password';
            }
        } else {
            $errors['email'] = 'email';
        }
        
        return response()->json([
                'message' => 'OK',
                'data' => $errors,
            ], 200);
    }
}
