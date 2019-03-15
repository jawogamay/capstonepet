<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    //
    protected $fillable = [
      'petname','user_id'
    ];

    public function user(){
        $this->belongsTo('App\User');
    }
}
