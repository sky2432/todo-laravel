<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $item = new TodoList;
        $item ->fill($request->all())->save();

        return response()->json([
            'message' => 'Created successfully',
            'data' => $item,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TodoList  $TodoList
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $items = TodoList::where('user_id', $id)
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
     * @param  \App\Models\TodoList  $TodoList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $item = TodoList::find($id);
        $item ->fill($request->all())->save();

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
     * @param  \App\Models\TodoList  $TodoList
     * @return \Illuminate\Http\Response
     */
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
