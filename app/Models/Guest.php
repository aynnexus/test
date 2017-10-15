<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{	
	protected $primaryKey = 'guest_id';
    protected $fillable = ['comment','rating_key','rating_value','status','profile_photo','social_id','type','type','custom_1','custom_2','phone','age','name','email','gender','os'];

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
    	return $this->hasOne(Site::class,'site_id','site_id');
    }

    public function scopeSearch($query,$request)
    {   
        if ($request['name']) {
            $query->where('name', 'like','%'.$request['name'].'%');
        }
        if($request['from_date']){

            //$query->whereBetween('created_at',[$request['from_date'],$request['to_date']]);
        }

        return $query->where('site_id',$request['site_id']);                     
    }

    public function Surveys()
    {
        return $this->hasMany(Survey::class,'guest_id');
    }
}
