<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $primaryKey = 'client_id';

    public function site()
    {
    	return $this->hasOne(Site::class,'site_id','site_id');
    }
}
