<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Models\User;

class SendLoginMailController extends Controller
{
    public function show($id)
    {
        $item = User::find($id);

        Mail::send(['text' => 'emails.login_mail'], ['item' => $item], function ($message) use ($item) {
            $message->to($item->email)
                ->from('todolist@test.com', 'Todoリスト')->subject('ログイン通知');
        });
    }
}
