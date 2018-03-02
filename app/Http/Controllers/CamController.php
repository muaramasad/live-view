<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Site;
use App\Division;
use App\Area;
use App\Cam;
use File;

class CamController extends Controller
{
    public function index()
    {
    	// $cams = Cam::with('site')->get();
    	// return view('cams.index',['cams' => $cams]);
        return redirect()->route('site.index');
    }
    public function create(Request $request,$id)
    {
    	$areas = Area::pluck('area_name','id');
    	//Get specific site by id and pass only site_name and id
    	$sites = Site::where('id',$id)->pluck('site_name','id')->toArray();
    	$site = Site::find($id);
    	return view('cams.create',[
    		'sites' => $sites,
    		'areas' => $areas,
    		'site' => $site
    	]);
    }
    public function edit($id,$siteId)
    {
    	$sites = Site::pluck('site_name','id');
    	$site = Site::find($siteId);
        $cam = Cam::find($id);
        $divisions = Division::pluck('division_name','id');
        $areas = Area::pluck('area_name','id');
        return view('cams.edit',[
            'cam' => $cam,
            'sites' => $sites,
            'site' => $site,
        ]);
    }
    public function store(Request $request)
    {
    	$validatedData = $request->validate([
	        'cam_name' => 'required|max:255',
	        'site_id' => 'required',
	        'cor_x' => 'required',
	        'cor_y' => 'required',
	        'cam_ip_address' => 'required|unique:cams'
	    ]);
        $cam = new Cam;
        $cam->cam_name = $request->input('cam_name');
        $cam->site_id = $request->input('site_id');
        $cam->cam_cor_x = $request->input('cor_x');
        $cam->cam_cor_y = $request->input('cor_y');
        $cam->cam_ip_address = $request->input('cam_ip_address');
        $cam->cam_file_path = $request->input('video_url');
        $cam->save();
        $videoPath = public_path(). DIRECTORY_SEPARATOR .'video'. DIRECTORY_SEPARATOR . preg_replace("/\./", "", $cam->cam_ip_address);
        if(!File::exists($videoPath)) {
           File::makeDirectory($videoPath, 0775);
        }
	    $request->session()->flash('is-success', 'CCTV successfully added!');
        return redirect()->route('cam.listBySite', $cam->site_id);
    }
    public function editStore(Request $request,$id)
    {
        $validatedData = $request->validate([
	        'cam_name' => 'required|max:255',
	        'cor_x' => 'required',
	        'cor_y' => 'required',
	        'cam_ip_address' => 'required|unique:cams'
	    ]);
        $videoPathNew = public_path(). DIRECTORY_SEPARATOR .'video'. DIRECTORY_SEPARATOR . preg_replace("/\./", "",$request->input('cam_ip_address'));
        $cam = Cam::find($id);
        $videoPathOld = public_path(). DIRECTORY_SEPARATOR .'video'. DIRECTORY_SEPARATOR . $cam->cam_ip_address;
        if(File::exists($videoPathOld)) {
            if($cam->cam_ip_address != null){
                File::deleteDirectory($videoPathOld);
            }
            File::makeDirectory($videoPathNew, 0775);
        } else {
            File::makeDirectory($videoPathNew, 0775);
        }
        $cam->cam_name = $request->input('cam_name');
	    $cam->cam_cor_x = $request->input('cor_x');
	    $cam->cam_cor_y = $request->input('cor_y');
	    $cam->cam_ip_address = $request->input('cam_ip_address');
	    $cam->cam_file_path = $request->input('video_url');
        $cam->save();
        $request->session()->flash('is-success', 'CCTV successfully updated!');
        return redirect()->route('cam.listBySite',$cam->site_id);
    }
    public function listBySiteId($id)
    {
        $site = Site::find($id);
    	$cams = Cam::where('site_id',$id)->paginate(10);
    	return view('cams.index',[
            'cams' => $cams,
            'site' => $site,
        ]);
    }
    public function destroy(Request $request, $id)
    {
        $cam = Cam::find($id);
        $camSiteId = $cam->site_id;
        $cam->delete();
        $request->session()->flash('is-success', 'CCTV successfully removed!');
        return redirect()->route('cam.listBySite',$camSiteId);
    }
}
