<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $primaryKey = 'client_id';

    public function site($id)
    {	
    	return Site::whereIn('site_id',json_decode($id))->pluck('site_name','site_id');    	
    }
    
}
