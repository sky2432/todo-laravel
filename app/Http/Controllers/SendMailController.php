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
    }

    public function loginMail(Request $request)
    {
        $item = User::where('email', $request->email)->first();
        
        $item->notify(new LoginNotification);
    }
}
