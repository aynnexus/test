<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $primaryKey = 'rating_id';

    public function Rate()
    {
    	return $this->hasOne(Rate::class,'rate_id','rate_id');
    }
}
