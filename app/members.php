<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class members extends Model
{
    public function (){
    	$this->belongsTo('App\agents');
    }
}
