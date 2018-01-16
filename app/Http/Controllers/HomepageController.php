<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Division;
use App\Area;
use App\Site;

class HomepageController extends Controller
{
    public function index()
    {
    	$divisions = Division::orderBy('division_name', 'asc')->get();
    	return view('homepage',[
    		'divisions' => $divisions
    	]);
    }
    public function mapDiv($id)
    {
    	$division = Division::find($id);
    	$sites = Site::where('division_id',$id)->get();
    	$areas = Area::where('division_id',$id)->get();
    	return view('maps.div',[
    		'areas' => $areas,
    		'division' => $division,
    		'sites' => $sites
    	]);
    }
}
