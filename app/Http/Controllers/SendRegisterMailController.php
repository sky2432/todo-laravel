<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class SendRegisterMailController extends Controller
{
    //
    public function post(Request $request)
    {
        $item = User::where('email', $request->email)->first();

        Mail::send(['text' => 'emails.register_mail'], ['item' => $item], function ($message) use ($item) {
            $message->to($item->email)
                ->from('todolist@test.com', 'Todoリスト')->subject('会員登録完了通知');
        });
    }
}
