<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendLoginMail;
use App\Models\Member;

class SendLoginMailController extends Controller
{
    public function show($id)
    {
        $item = Member::find($id);

        // Mail::to($user)->send(new SendLoginMail($user));

        // return response()->json([
        //     'data' => $user,
        // ]);
        Mail::send(['text' => 'emails.LoginMail'], ['item' => $item], function ($message) use ($item) {
            $message->to($item->email)
                ->from('todolist@test.com', 'Todoリスト')->subject('ログイン通知');
        });
    }
}
