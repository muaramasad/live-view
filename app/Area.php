<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'area_name', 'division_id'
    ];
    public function sites()
    {
        return $this->hasMany('App\Site','area_id','id');
    }
    public function division()
	{
    	return $this->belongsTo('App\Division');
	}
    public function province()
    {
        return $this->belongsTo('App\Province');
    }
    public function user(){
        return $this->belongsToMany('App\User')->withPivot('user_id','division_id')->withTimestamps();
    }
}
