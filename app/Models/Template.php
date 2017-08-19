<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $primaryKey = 'template_id';
    protected $fillable = ['step','status'];
    
    public function scopeActive()
    {
    	return $this->where('status',ACTIVE);
    }

    public function Profile()
    {
    	return $this->hasOne(SiteProfile::class,'template_id');
    }

    public function Field()
    {
    	return $this->hasOne(SiteField::class,'template_id');
    }

    public function Site($id)
    {   
        return Site::whereIn('site_id',json_decode($id))->pluck('site_name','site_id');     
    }

    public function User()
    {
        return $this->hasOne('App\User','id');
    }

    public function AllSite($id)
    {   
        return Site::whereIn('site_id',json_decode($id))->get();     
    }
}
