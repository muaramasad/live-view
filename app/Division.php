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
        return $this->hasMany('App\Area');
    }
}
