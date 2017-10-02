<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteProfile extends Model
{	
	protected $table = 'landing_profiles';
    protected $primaryKey = 'profile_id';
    protected $fillable = ['header_image','footer_image','logo_image','background_image'];    
}
