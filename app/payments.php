<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class payments extends Model
{
    public function agent(){
    	return $this->belongsTo('App\agents');

    }




    public function admin(){
    	return $this->belongsTo('App\users');

    }
}
