<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteField extends Model
{	
	protected $table = 'landing_fields';
    protected $primaryKey = 'field_id';
    protected $fillable = ['feedback_fields'];	

    public function step()
    {
    	return $this->hasOne(Site::class,'site_id','site_id')->value('step');
    }
}
