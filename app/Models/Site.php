<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $primaryKey = 'site_id';  
    public function Field()
    {
    	return $this->hasOne(SiteField::class,'site_id');
    }

    public function Profile()
    {
    	return $this->hasOne(SiteProfile::class,'site_id');
    }

    public function scopeInactive()
    {
        return $this->where('status',INACTIVE);
    }

    public function scopeActive()
    {
        return $this->where('status',ACTIVE);
    }

    public function Guests()
    {
        return $this->hasMany(Guest::class,'site_id');
    }
    
    public function scopeSearch($query,$request)
    {
        return $query->where('site_name', 'like','%'.$request['name'].'%');
    }

    public function scopeNameSearch($query,$request)
    {        
        return $query->where('site_name', 'like','%'.$request['name'].'%');
    }
}
