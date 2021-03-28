<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo_list;
use App\Models\Member;
use Illuminate\Support\Facades\DB;


class DeleteAccountController extends Controller
{
    //
    public function destroy($id) {
        Todo_list::where('member_id', $id)->delete();
        Member::where('id', $id)->delete();

        return response()->json([
            'message' => 'Account Deleted',
        ]);
    }
}
