<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
            'name',
            'email',
    ];

    public function todoLists()
    {
        return $this->hasMany('App\Models\TodoList');
    }

    // public function __construct()
    // {
    //     $this->file_path = config('data.DEFAULT_IMAGE');
    // }

    public function routeNotificationForMail($notification)
    {
        return $this->email;
    }
    
    public function routeNotificationForNexmo($notification)
    {
        return $this->phone_number;
    }
}
