<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function store(Request $request)
    {
        $item = new TodoList;
        $item->fill($request->all())->save();

        return response()->json([
            'message' => 'Created successfully',
            'data' => $item,
        ]);
    }

    public function show($id)
    {
        $items = TodoList::where('user_id', $id)
        ->where('status', true)
        ->latest('id')
        ->get();
        
        return response()->json([
                'message' => 'OK',
                'data' => $items
            ], 200);
    }

    public function update(Request $request, $id)
    {
        $item = TodoList::find($id)->fill($request->all())->save();

        if ($item) {
            return response()->json([
                'message' => 'Updated successfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
    }

    public function destroy($id)
    {
        $item = TodoList::find($id);
        $item->status = false;
        $item->save();

        if ($item) {
            return response()->json([
                'message' => 'Done successfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
    }
}
