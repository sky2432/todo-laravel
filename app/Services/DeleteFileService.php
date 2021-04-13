<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

class DeleteFileService
{
    public static function deleteFile($id)
    {
        $record = User::find($id);
        $fileName = $record->file_path;
        if ($fileName && $fileName !== config('data.DEFAULT_IMAGE') && $fileName !== config('data.DEFAULT_IMAGE2') && $fileName !== config('data.DEFAULT_IMAGE3')) {
            Storage::delete('public/image/' .$fileName);
        }
    }
}
