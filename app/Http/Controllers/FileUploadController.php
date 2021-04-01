<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    //
    public function show($id)
    {
        $item = Member::find($id);
        return response()->json([
            'message' => 'UserImage Get Ok',
            'data' => $item,
        ]);
    }

    public function update(Request $request, $id)
    {
        $record = Member::find($id);
        $fileName = $record->file_path;
        if ($fileName && $fileName !== '猫.jpg') {
            Storage::delete('public/image/' .$fileName);
        }

        $now = Carbon::now();
        $time = $now->format('Y-m-d_H-i-s');
        $file_name = $time . request()->file->getClientOriginalName();
        
        request()->file->storeAs('public/image/', $file_name);
        
        $item = Member::find($id);
        $item->file_path = $file_name;
        $item->save();
        
        return response()->json([
            'data' => $item,
            'message' => 'Upload Ok'
        ]);
    }
}
