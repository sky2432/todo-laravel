<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    public function todo_lists()
    {
        return $this->hasMany('App\Models\Todo_list');
    }
}
