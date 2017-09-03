<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    protected $primaryKey = 'movement_id';
    protected $fillable = ['site_id','visited'];
    
    public function scopeMovementStore($query,$id)
    {
    	return $query->create(['site_id'=>$id,'visited'=>ACTIVE]);
    }
}
