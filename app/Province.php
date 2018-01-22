<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public function areas()
    {
        return $this->hasMany('App\Area','province_id','id');
    }
}
