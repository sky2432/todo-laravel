<?php

namespace App\Http\Controllers;

use App\Models\Todo_list;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $item = new Todo_list;
        $item->member_id = $request->id;
        $item->todo_list = $request->todo;
        $item->status = true;
        $item->save();
        return response()->json([
            'message' => 'Created successfully',
            'data' => $item,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo_list  $todo_list
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $items = DB::table('todo_lists')
        ->where('member_id', $id)
        ->where('status', true)
        ->orderBy('id', 'desc')
        ->get();
        
        return response()->json([
                'message' => 'OK',
                'data' => $items
            ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo_list  $todo_list
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $item = Todo_list::find($id);
        $item->todo_list = $request->todo_list;
        $item->save();

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo_list  $todo_list
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Todo_list::find($id);
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
