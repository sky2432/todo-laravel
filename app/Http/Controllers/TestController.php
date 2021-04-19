<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use App\Models\User;
use App\Notifications\LoginNotification;
use App\Notifications\RegisterNotification;
use App\Notifications\PassedNotification;
use Carbon\Carbon;


class TestController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        dd($now);
    }
}
