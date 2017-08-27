<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $primaryKey = 'rate_id';
    protected $fillable = ['rate_id','created_by','label','status'];
}
