<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class FileUploadController extends Controller
{
    //
    public function update(Request $request, $id) {

        $file_name = request()->file->getClientOriginalName();

        request()->file->storeAs('public/', $file_name);

        $item = Member::find($id);
        $item->file_path = '/storage/'.$file_name;
        $item->save();
        
        return response()->json([
            'data' => $item,
        ]);
    }
}
