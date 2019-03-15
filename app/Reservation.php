<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
class Reservation extends Model
{
    use Notifiable, HasApiTokens;
    protected $fillable = [
        'firstname','lastname','middlename',''
    ];
}
