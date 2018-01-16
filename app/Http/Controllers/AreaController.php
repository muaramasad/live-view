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
    public function edit($id)
    {
        $area = Area::find($id);
        $divisions = Division::pluck('division_name','id');
        return view('areas.edit',[
            'area' => $area,
            'divisions' => $divisions
        ]);
    }
    public function store(Request $request)
	{
	    $validatedData = $request->validate([
	        'area_name' => 'required|max:255',
	        'division_id' => 'required'
	    ]);
	    $area = new Area;
        $area->area_name = $request->area_name;
        $area->division_id = $request->division_id;
        $area->save();
        $request->session()->flash('is-success', 'Area successfully added!');
        return redirect()->route('area.index');
	}
    public function editStore(Request $request,$id)
    {
        $validatedData = $request->validate([
            'area_name' => 'required|max:255',
            'division_id' => 'required',
        ]);
        $area = Area::find($id);
        $area->area_name = $request->area_name;
        $area->division_id = $request->division_id;
        $area->save();
        $request->session()->flash('is-success', 'Area successfully updated!');
        return redirect()->route('area.index');
    }
    public function destroy(Request $request, $id)
    {
        if (Area::has('sites')->find($id)) {
            return redirect()->route('area.index')->withErrors(['error' => 'This area still has sites, remove the sites first !']);
        }
        Area::find($id)->delete();
        $request->session()->flash('is-success', 'Area successfully removed!');
        return redirect()->route('area.index');
    }
}
