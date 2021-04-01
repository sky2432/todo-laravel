<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FormValidateController extends Controller
{
    //
    public function post(Request $request) {
        $errors = [];

        $nameItem = User::where('name', $request->name)->first();

        $emailItem = User::where('email', $request->email)->first();

        if($nameItem) {
            $errors['name'] = 'duplicate';
        }
        if($emailItem) {
            $errors['email'] = 'duplicate';
        }
        if(strlen($request->password) < 4) {
            $errors['password'] = 'length';
        }
        
        return response()->json([
            'message' => 'OK',
            'data' => $errors,
        ]);
    }
}
