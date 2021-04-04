<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;

class SendMailService
{
    public static function sendMail($item, $view, $subject)
    {
        Mail::send(['text' => $view], ['item' => $item], function ($message) use ($item, $subject) {
            $message->to($item->email)
                ->from('todolist@test.com', 'Todoリスト')->subject($subject);
        });
    }
}
