<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class districts extends Model
{
    protected $table = 'districts';




    public function agents(){
    	return $this->hasMany('App\agents');
    }
}