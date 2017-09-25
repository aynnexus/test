<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $primaryKey = 'client_id';
    protected $fillable = ['status'];
    
    public function scopeActive()
    {
        return $this->where('status',ACTIVE);
    }

    public function site($id)
    {	
    	return Site::whereIn('site_id',json_decode($id))->pluck('site_name','site_id');    	
    }
    
    public function User()
    {
    	return $this->hasOne('App\User','id','user_id');
    }

    public function Allsite($id)
    {   
        return Site::whereIn('site_id',json_decode($id))->get();     
    }
}
