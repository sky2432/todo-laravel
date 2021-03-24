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
    public function index()
    {
        //
        // $items = Todo_list::all();
        $items = DB::table('todo_lists')
        ->orderBy('id', 'desc')
        ->get();
        return response()->json([
            'message' => 'OK',
            'data' => $items
        ], 200);
    }

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
        $item->created_at = now();
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
    public function show(Todo_list $todo_list)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo_list  $todo_list
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo_list $todo_list)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo_list  $todo_list
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo_list $todo_list)
    {
        //
    }
}
