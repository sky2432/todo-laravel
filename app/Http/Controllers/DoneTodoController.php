<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo_list;
use Illuminate\Support\Facades\DB;

class DoneTodoController extends Controller
{
    //
    public function show($id)
    {
        $items = DB::table('todo_lists')
        ->where('member_id', $id)
        ->where('status', false)
        ->orderBy('id', 'desc')
        ->get();
        
        return response()->json([
                'message' => 'OK',
                'data' => $items
            ], 200);
    }

    public function update($id)
    {
        $item = Todo_list::find($id);
        $item->status = true;
        $item->save();

        return response()->json([
            'message' => 'Return successfully',
        ], 200);
    }

    public function destroy($id)
    {
        Todo_list::find($id)->delete();
        
        return response()->json([
            'message' => 'Delete successfully',
        ], 200);
    }
}
