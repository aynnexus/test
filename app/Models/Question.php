<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{	
	protected $table = 'servey_questions';
    protected $primaryKey = 'question_id';

    public function Answer()
    {
    	return $this->hasMany(Answer::class);
    }

    public function User()
    {
    	return $this->hasOne('App\User','id','created_by');
    }

    public function Answers()
    {
        return $this->hasMany(Answer::class,'question_id','question_id');
    }
}
