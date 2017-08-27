<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surveying extends Model
{
	protected $table = 'surveying';
    protected $primaryKey = 'surveying_id';

   	public function Survey()
   	{
   		return $this->hasOne(Survey::class,'survey_id','survey_id');
   	}
}
