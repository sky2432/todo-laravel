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
        if ($fileName && !preg_match("/defaultImage/", $fileName )) {
            Storage::delete('public/image/' .$fileName);
        }
    }
}
