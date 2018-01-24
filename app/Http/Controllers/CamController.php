<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Site;
use App\Division;
use App\Area;
use App\Cam;

class CamController extends Controller
{
    public function index()
    {
    	$cams = Cam::with('site','area')->get();
    	return view('cams.index',['cams' => $cams]);
    }
    public function create()
    {
    	$areas = Area::pluck('area_name','id');
    	$sites = Site::pluck('site_name','id');
    	return view('cams.create',[
    		'sites' => $sites,
    		'areas' => $areas
    	]);
    }
}
