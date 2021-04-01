<?php

namespace App\Http\Controllers;

use App\Models\TodoList;

class DoneTodoController extends Controller
{
    //
    public function show($id)
    {
        $items = TodoList::where('user_id', $id)
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
        $item = TodoList::find($id);
        $item->status = true;
        $item->save();

        return response()->json([
            'message' => 'Return successfully',
        ], 200);
    }

    public function destroy($id)
    {
        TodoList::find($id)->delete();
        
        return response()->json([
            'message' => 'Delete successfully',
        ], 200);
    }
}
