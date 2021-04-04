<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use App\Services\DeleteFileService;


class FileController extends Controller
{
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
        DeleteFileService::deleteFile($id);

        $time = Carbon::now()->format('Y-m-d_H-i-s_');
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
