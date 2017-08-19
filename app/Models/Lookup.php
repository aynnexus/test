<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lookup extends Model
{	
	protected $primaryKey = 'lookup_id';

    public function scopeActive()
    {
        return $this->where('status',ACTIVE);
    }

    public function User()
    {
        return $this->hasOne('App\User','id','created_by');
    }
}
