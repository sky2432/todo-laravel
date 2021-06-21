<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

class DeleteFileService
{
    public static function deleteFile($id)
    {
        $item = User::find($id);
        $file_name = basename($item->file_path);
        if (Storage::disk('s3')->exists($file_name) && $item->file_path !== config('data.DEFAULT_IMAGE_URL')) {
            Storage::disk('s3')->delete($file_name);
        } else {
            return;
        }
    }
}
