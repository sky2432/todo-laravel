<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Services\SendMailService;
use App\Notifications\RegisterNotification;
use App\Notifications\LoginNotification;

class SendMailController extends Controller
{
    public function registerMail(Request $request)
    {
        $item = User::where('email', $request->email)->first();

        $item->notify(new RegisterNotification);

        // SendMailService::sendMail($item, config('data.REGISTER_MAIL_VIEW'), config('data.REGISTER_MAIL_SUBJECT'));
    }

    public function loginMail(Request $request)
    {
        $item = User::where('email', $request->email)->first();
        
        $item->notify(new LoginNotification);

        // SendMailService::sendMail($item, config('data.LOGIN_MAIL_VIEW'), config('data.LOGIN_MAIL_SUBJECT'));
    }
}
