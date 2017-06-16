<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roomtype extends Model
{
    //

    public function room(){

		return $this->hasMany('App\Room');
	}
}
