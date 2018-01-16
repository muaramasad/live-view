<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;
use App\Division;

class AreaController extends Controller
{
    public function index()
    {
    	$areas = Area::with('division')->get();
    	return view('areas.index',['areas' => $areas]);
    }
    public function create()
    {
    	$divisions = Division::pluck('division_name','id');
    	return view('areas.create',[
    		'divisions' => $divisions
    	]);
    }
    public function store(Request $request)
	{
	    $validatedData = $request->validate([
	        'area_name' => 'required|max:255',
	        'division_id' => 'required',
	    ]);
	    $area = new Area;
        $area->area_name = $request->area_name;
        $area->division_id = $request->division_id;
        $area->save();
        return redirect()->route('area.create');
	}
}
