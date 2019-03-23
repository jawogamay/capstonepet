<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qr extends Model
{
   
       protected $fillable = [
      'reservation_id','reference'
    ];

    public function reservation(){
        return $this->belongsTo('App\Reservation');

    }
}
