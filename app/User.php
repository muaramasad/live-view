<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function division(){
        return $this->belongsToMany('App\Division')->withPivot('user_id','division_id')->withTimestamps();
    }

    public function area(){
        return $this->belongsToMany('App\Area')->withPivot('user_id','area_id')->withTimestamps();
    }

    public function site(){
        return $this->belongsToMany('App\Site')->withPivot('user_id','site_id')->withTimestamps();
    }
}
