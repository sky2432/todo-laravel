<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class UpdateUserController extends Controller
{
    //
    public function update(Request $request, $id)
    {
        $errors = [];

        $nameItem = Member::where('id', '!=', $id)->get()->where('name', $request->name)->first();
        $emailItem = Member::where('id', '!=', $id)->get()->where('email', $request->email)->first();
        
        if ($nameItem) {
            $errors['name'] = 'duplicate';
        }
        if ($emailItem) {
            $errors['email'] = 'duplicate';
        }

        if (!$nameItem && !$emailItem) {
            $item = Member::find($id);
            $item->name = $request->name;
            $item->email = $request->email;
            $item->save();
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
