<?php

namespace App\Classes;

use Illuminate\Database\Eloquent\Model;

class User_Info extends Model
{
    protected $table = 'user_info';

    public function user()
    {
        return $this->belongsTo('App\Classes\Users', 'user_id');
    }
}