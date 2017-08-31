<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{	
	protected $table  = 'servey_answers';
    protected $primaryKey = 'answer_id';

    public function User()
    {
    	return $this->hasOne('App\User','id','created_by');
    }

    public function Question()
    {
    	return $this->hasOne(Question::class,'question_id','question_id');
    }
}
