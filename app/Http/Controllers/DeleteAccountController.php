<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo_list;
use App\Models\Member;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;



class DeleteAccountController extends Controller
{
    //
    public function destroy($id) {
        Todo_list::where('member_id', $id)->delete();
        $record = Member::find($id);
        $fileName = $record->file_path;
        if ($fileName && $fileName !== '猫.jpg') {
            Storage::delete('public/image/' .$fileName);
        }
        Member::where('id', $id)->delete();

        return response()->json([
            'message' => 'Account Deleted',
        ]);
    }
}
