<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TodoList;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Services\DeleteFileService;

class UserController extends Controller
{
    public function confirm(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email:rfc,dns|unique:App\Models\User,email',
            'password' => 'required|min:4',
        ]);

        return response()->json([
            'message' => 'Validate OK',
        ]);
    }

    public function index()
    {
        $item = User::where('role', 'user')->get();

        return response()->json([
            'message' => 'ok',
            'data' => $item
        ], 200);
    }

    public function show($id)
    {
        $item = User::find($id);

        return response()->json([
            'message' => 'ok',
            'data' => $item
        ], 200);
    }

    public function store(Request $request)
    {
        $item = new User();
        $item->fill($request->all());
        $item->password = Hash::make($request->password);
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

    public function updatePassword(Request $request)
    {
        $item = User::find($request->id);
        UpdatePasswordRequest::rules($request, $item);

        $item->password = Hash::make($request->newPassword);
        $item->save();

        return response()->json([
                'message' => 'Ok',
                'data' => $item,
            ]);
    }
}
