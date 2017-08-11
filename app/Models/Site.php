<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $primaryKey = 'site_id';  

    protected $fillable = ['step']; 

    public function Field()
    {
    	return $this->hasOne(SiteField::class,'site_id');
    }

    public function Profile()
    {
    	return $this->hasOne(SiteProfile::class,'site_id');
    }
}
