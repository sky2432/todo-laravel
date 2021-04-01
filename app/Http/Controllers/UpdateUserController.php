<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UpdateUserController extends Controller
{
    public function update(Request $request, $id)
    {
        $errors = [];

        $nameItem = User::whereNotIn('id', [$id])->where('name', $request->name)->first();
        $emailItem = User::whereNotIn('id', [$id])->where('email', $request->email)->first();
        
        if ($nameItem) {
            $errors['name'] = 'duplicate';
        }
        if ($emailItem) {
            $errors['email'] = 'duplicate';
        }

        if (!$nameItem && !$emailItem) {
            $item = User::find($id);
            $item ->fill($request->all())->save();

            return response()->json([
                'data' => $item,
                'message' => 'Ok',
            ]);
        } else {
            return response()->json([
                'data' => $errors,
                'message' => 'error'
            ]);
        }
    }
}
