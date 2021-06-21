<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\DeleteFileService;
use Illuminate\Support\Facades\Storage;

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

        $path = Storage::disk('s3')->putFile('/', request()->image, 'public');
        $url = Storage::disk('s3')->url($path);

        $item = User::find($id);
        $item->file_path = $url;
        $item->save();

        return response()->json([
            'data' => $item,
            'message' => 'Upload Ok'
        ]);
    }
}
