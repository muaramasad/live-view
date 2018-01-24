<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Division;
use App\Area;
use App\Site;
use App\Province;
use Mapper;

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
        Mapper::map(-1.7922201, 116.9502052, ['zoom' => '5','center' => true, 'marker' => false, 'cluster' => false]);
        $provinceId = [];
    	$division = Division::find($id);
    	$sites = Site::where('division_id',$id)->get();
    	$areas = Area::where('division_id',$id)->with('province')->get();
        foreach ($areas as $area) {
            if ($area->has('sites')) {
                $provinceId[] = $area->province->id;
            }
        }
        $ProvinceCollection = Province::find($provinceId);
        $ProvinceCollection->each(function($province)
        {
            $content = $province->province_name;
            Mapper::marker($province->province_cor_x, $province->province_cor_y,['eventClick' => 'window.location.href = "/map/province/'.$province->province_code.'";']);
        });
    	return view('maps.div',[
    		'areas' => $areas,
    		'division' => $division,
    		'sites' => $sites
    	]);
    }
    public function mapDivProvince($pcode)
    {
        $sitesId = [];
        $province = Province::where('province_code',$pcode)->first();
        Mapper::map($province->province_cor_x, $province->province_cor_y, ['zoom' => $province->province_zoom,'center' => true, 'marker' => false, 'cluster' => true]);
        $areas = Area::where('province_id',$province->id)->with('sites')->get();
        foreach ($areas as $area) {
            if ($area->has('sites')) {
                foreach ($area->sites as $site) {
                    $sitesId[] = $site->id;
                }
            }
        }
        $sitesCollection = Site::find($sitesId);
        $sitesCollection->each(function($site)
        {
            Mapper::informationWindow($site->cor_x, $site->cor_y, $site->site_name, ['open' => true, 'maxWidth'=> 300, 'markers' => ['title' => 'Title','eventClick' => 'window.location.href = "/map/site/'.$site->id.'";']]);
            // Mapper::marker($site->cor_x, $site->cor_y,['eventClick' => 'window.location.href = "/map/site/'.$site->id.'";', 'eventMouseOver' => '']);
        });
        $division = Division::find(1);
        return view('maps.prov',[
            'division' => $division,
            'prov' => $province,
        ]);
    }
    public function mapDivSite($id)
    {
        $site = Site::find($id);
        Mapper::map($site->cor_x, $site->cor_y, ['zoom' => 18,'center' => true, 'marker' => false, 'cluster' => false, 'type' => 'SATELLITE']);
        Mapper::marker(-6.627275926222313,107.55596948217772 ,['eventClick' => 'showModal();']);
        $area = Area::find($site->area_id);
        $prov = Province::find($area->province_id);
        $division = Division::find(1);
        return view('maps.site',[
            'division' => $division,
            'prov' => $prov,
            'site' => $site,
        ]);
    }
}
