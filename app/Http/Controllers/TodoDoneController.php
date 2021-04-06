<?php

namespace App\Http\Controllers;

use App\Models\TodoList;

class TodoDoneController extends Controller
{
    //
    public function show($id)
    {
        $items = TodoList::where('user_id', $id)
        ->where('status', false)
        ->latest('updated_at')
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
        TodoList::destroy($id);
        
        return response()->json([
            'message' => 'Delete successfully',
        ], 200);
    }
}
