<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoList extends Model
{
    use HasFactory;

    protected $fillable = [
            'user_id',
            'todo_list',
            'deadline',
            'status',
    ];


    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
