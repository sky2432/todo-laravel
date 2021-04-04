<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TodoList;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserUpdateRequest;
use App\Services\DeleteFileService;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $item = new User();
        $item->fill($request->all());

        $hashed_password = Hash::make($request->password);

        $item->password = $hashed_password;
        $item->save();

        return response()->json([
            'message' => 'User created successfully',
            'data' => $item
        ], 200);
    }

    public function update(Request $request, $id)
    {
        UserUpdateRequest::rules($request, $id);
            
        $item = User::find($id);
        $item ->fill($request->all())->save();

        return response()->json([
                'message' => 'Ok',
                'data' => $item,
            ]);
    }

    public function destroy($id)
    {
        TodoList::where('user_id', $id)->delete();

        DeleteFileService::deleteFile($id);

        User::destroy($id);

        return response()->json([
            'message' => 'Account Deleted',
        ]);
    }
}
