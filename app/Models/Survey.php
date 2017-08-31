<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $primaryKey = 'survey_id';
    protected $fillable = ['survey_id','created_by','label','status'];
}
