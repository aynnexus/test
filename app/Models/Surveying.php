<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surveying extends Model
{
	protected $table = 'surveying';
    protected $primaryKey = 'surveying_id';

   	public function Question()
   	{
   		return $this->hasOne(Question::class,'question_id','survey_id');
   	}
}
