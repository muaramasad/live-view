<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideoRequest;
use App\Jobs\ConvertVideoForStreaming;
use Illuminate\Http\Request;
use App\Division;
use App\Area;
use App\Site;
use App\Province;
use App\Cam;
use Mapper;
use FFMpeg;
use FFMpeg\Format\Video\X264;


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
        Mapper::map($province->province_cor_x, $province->province_cor_y, ['zoom' => $province->province_zoom,'center' => true, 'marker' => false, 'cluster' => true, 'type' => 'SATELLITE']);
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
            Mapper::informationWindow($site->cor_x, $site->cor_y, $site->site_name, ['open' => true, 'maxWidth'=> 300, 'markers' => ['eventClick' => 'window.location.href = "/map/site/'.$site->id.'";']]);
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
        $camsCollection = Cam::where('site_id',$site->id)->get();
        $i = 1;
        $camsCollection->each(function($cam,$i)
        {
            $content = '<h4>'.strtoupper($cam->cam_name).'</h4><p>IP Address: '.$cam->cam_ip_address.'</p>';
            Mapper::marker($cam->cam_cor_x, $cam->cam_cor_y, ['content' => $content,'icon' => ['url' => '/images/placeholder.svg','size' => 24],'eventMouseOver' => 'infowindow_'.$i.'.open(map, this);','eventMouseOut' => 'infowindow_'.$i.'.close(map, this);', 'eventClick' => 'showModal('.$cam->id.','.preg_replace("/\./", "",$cam->cam_ip_address).',"'.$cam->cam_name.'");' ]);
            // Mapper::informationWindow($cam->cam_cor_x, $cam->cam_cor_y, $content, ['maxWidth'=> 300, 'icon' => ['url' => '/images/placeholder.svg','size' => 24],'eventMouseOver' => 'infowindow.open(map, this);']);
            // Mapper::marker($cam->cam_cor_x, $cam->cam_cor_y,['icon' => ['url' => '/images/placeholder.svg','size' => 24],'eventMouseOver' => 'infowindow.open(map, this);']);
            // Mapper::marker($cam->cam_cor_x,$cam->cam_cor_y,['eventClick' => 'showModal();']);
            $i++;
        });
        $area = Area::find($site->area_id);
        $prov = Province::find($area->province_id);
        $division = Division::find(1);
        return view('maps.site',[
            'division' => $division,
            'prov' => $prov,
            'site' => $site,
            'cams' => $camsCollection
        ]);
    }
}
