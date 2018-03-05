<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $fillable = [
        'division_name', 'icon_path'
    ];
    public function areas()
    {
        return $this->hasMany('App\Area','division_id','id');
    }
    public function user(){
        return $this->belongsToMany('App\User')->withPivot('user_id','division_id')->withTimestamps();
    }
}
