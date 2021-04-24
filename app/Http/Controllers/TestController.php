<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use App\Models\User;
use App\Notifications\LoginNotification;
use App\Notifications\RegisterNotification;
use App\Notifications\PassedNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class TestController extends Controller
{
    public function index()
    {
        $now =Carbon::now()->format('Y/m/d H:i:s');
        $item = new User;
        $item->name = "みみ";
        $item->email = "test10@test.com";
        $item->password = Hash::make('1234');
        $item->created_at = $now;
        $item->updated_at = $now;
        $item->save();

        return response()->json([
            'message' => 'Account was created successfully',
            'date' => $now,
            'data' => $item
         ]);
    }
}
