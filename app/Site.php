<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $fillable = [
        'site_name', 'cor_x', 'cor_y', 'url_1', 'url_2', 'area_id', 'division_id'
    ];
 //    public function area()
	// {
 //    	return $this->belongsTo('App\Area','area_id','id');
	// }
    public function area()
    {
        return $this->belongsTo('App\Area','area_id','id');
    }
	public function division()
	{
    	return $this->belongsTo('App\Division','division_id','id');
	}
    public function cam()
    {
        return $this->hasMany('App\Cam','site_id','id');
    }
    public function user(){
        return $this->belongsToMany('App\User')->withPivot('user_id','division_id')->withTimestamps();
    }
}
