<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Services\SendMailService;

class SendMailController extends Controller
{
    public function registerMail(Request $request)
    {
        $item = User::where('email', $request->email)->first();

        SendMailService::sendMail($item, config('data.register_mail_view'), config('data.register_mail_subject'));
    }

    public function loginMail(Request $request)
    {
        $item = User::where('email', $request->email)->first();

        SendMailService::sendMail($item, config('data.login_mail_view'), config('data.login_mail_subject'));
    }
}
