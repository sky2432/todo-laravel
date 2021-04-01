<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class DeleteUserController extends Controller
{
    //
    public function destroy($id) {
        TodoList::where('user_id', $id)->delete();
        $item = User::find($id);
        $fileName = $item->file_path;
        if ($fileName && $fileName !== config('data.defaultImage')) {
            Storage::delete('public/image/' .$fileName);
        }
        User::where('id', $id)->delete();

        return response()->json([
            'message' => 'Account Deleted',
        ]);
    }
}
