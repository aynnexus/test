<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{	
	protected $primaryKey = 'guest_id';
    protected $fillable = ['comment','rating_key','rating_value'];

    public function Gender($value)
    {
    	return Lookup::where('title','GENDER')->where('key',$value)->value('value');
    }

    public function Age($value)
    {
    	return Lookup::where('title','Age Group')->where('key',$value)->value('value');
    }

    public function Site()
    {
    	return $this->hasOne(Site::class,'site_name','site_name');
    }
}
