<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\RegisterNotification;
use App\Notifications\LoginNotification;

class SendMailController extends Controller
{
    public function register(Request $request)
    {
        $item = User::where('email', $request->email)->first();

        $item->notify(new RegisterNotification);
    }

    public function login(Request $request)
    {
        $item = User::where('email', $request->email)->first();
        
        $item->notify(new LoginNotification);
    }
}
