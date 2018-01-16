<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Site;
use App\Division;
use App\Area;

class SiteController extends Controller
{
    public function index()
    {
    	$sites = Site::with('division','Area')->get();
    	return view('sites.index',['sites' => $sites]);
    }
    public function create()
    {
    	$divisions = Division::pluck('division_name','id');
    	$areas = Area::pluck('area_name','id');
    	return view('sites.create',[
    		'divisions' => $divisions,
    		'areas' => $areas,
    	]);
    }
    public function store(Request $request)
	{
	    $validatedData = $request->validate([
	        'site_name' => 'required|max:255',
	        'division_id' => 'required',
	        'area_id' => 'required',
	        'cor_x' => 'required',
	        'cor_y' => 'required',
	    ]);
	    $site = new Site;
        $site->site_name = $request->site_name;
        $site->division_id = $request->division_id;
        $site->area_id = $request->area_id;
        $site->cor_x = $request->cor_x;
        $site->cor_y = $request->cor_y;
        $site->url_1 = $request->url_1;
        $site->url_2 = $request->url_2;
        $site->save();
        return redirect()->route('site.index');
	}
	public function getAreaByDivision($id)
	{
		$area = Area::where('division_id',$id)->pluck('area_name','id');
		return $area;
	}
    public function getSiteByDivision($idDiv)
    {
        $sites = Site::where(['division_id' => $idDiv])->get();
        return $sites;
    }
    public function getSiteByDivisionArea($idDiv,$idArea)
    {
        $sites = Site::where(['division_id' => $idDiv,'area_id' => $idArea])->get();
        return $sites;
    }
}
