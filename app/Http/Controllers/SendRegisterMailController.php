<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendRegisterMail;




class SendRegisterMailController extends Controller
{
    //
    public function post(Request $request)
    {
        $user = Member::where('email', $request->email)->first();

        Mail::to($user)->send(new SendRegisterMail($user));

        return response()->json([
            'data' => $user,
        ]);
    }
}
