<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cam extends Model
{
    protected $fillable = [
        'cam_name', 'cam_cor_x', 'cam_cor_y', 'cam_ip_address', 'cam_file_path', 'site_id'
    ];
 //    public function area()
	// {
 //    	return $this->belongsTo('App\Area','area_id','id');
	// }
    public function site()
    {
        return $this->belongsTo('App\Site','site_id','id');
    }
}
