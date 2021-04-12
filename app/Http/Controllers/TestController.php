<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use App\Models\User;
use App\Notifications\LoginNotification;
use App\Notifications\RegisterNotification;
use App\Notifications\PassedNotification;


class TestController extends Controller
{
    public function index()
    {
        $user = User::find(1);
        // $item = TodoList::find(1);
        // $user = $item->user;
    
        // $user->notify(new LoginNotification);

        return (new LoginNotification)->toMail($user);
        // return (new RegisterNotification)->toMail($user);
        // return (new PassedNotification($user))->toMail($item);

    }
}
