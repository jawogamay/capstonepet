<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    //
    protected $fillable = [
        'name', 'email', 'password',
    ];
     protected $hidden = [
        'password', 'remember_token',
    ];
}
