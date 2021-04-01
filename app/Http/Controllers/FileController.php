<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    //
    public function show($id)
    {
        $item = User::find($id);
        return response()->json([
            'message' => 'UserImage Get Ok',
            'data' => $item,
        ]);
    }

    public function update($id)
    {
        $record = User::find($id);
        $fileName = $record->file_path;
        if ($fileName && $fileName !== config('data.defaultImage')) {
            Storage::delete('public/image/' .$fileName);
        }

        $now = Carbon::now();
        $time = $now->format('Y-m-d_H-i-s');
        $file_name = $time . request()->file->getClientOriginalName();
        
        request()->file->storeAs('public/image/', $file_name);
        
        $item = User::find($id);
        $item->file_path = $file_name;
        $item->save();
        
        return response()->json([
            'data' => $item,
            'message' => 'Upload Ok'
        ]);
    }
}
