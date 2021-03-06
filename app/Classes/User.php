<?php

namespace App\Classes;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','user_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    function adminCheck() {
        if(!isset($this->type) || $this->type != 'admin') {
            //Redirect::to('index')->send();
        }
    }

    public function user_info() {
        return $this->hasOne('App\Classes\User_Info', 'user_id');
    }
}
