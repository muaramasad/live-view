<?php

namespace App\Http\Controllers;

use Symfony\Component\Process\PhpProcess;
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
use Ping;


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
        $divLocation = array();
        foreach ($ProvinceCollection as $province) {
            $divLocation[] = [$province->province_name,$province->province_cor_x,$province->province_cor_y,$province->province_code];
        }
        // $ProvinceCollection->each(function($province)
        // {
        //     $content = $province->province_name;
        //     Mapper::marker($province->province_cor_x, $province->province_cor_y,['eventClick' => 'window.location.href = "/map/province/'.$province->province_code.'";']);
        // });
        return view('maps.div',[
            'areas' => $areas,
            'division' => $division,
            'sites' => $sites,
            'divLocation' => $divLocation
        ]);
    }
    public function mapDivProvince($divid, $pcode)
    {
        $sitesId = [];
        $province = Province::where('province_code',$pcode)->first();
        Mapper::map($province->province_cor_x, $province->province_cor_y, ['zoom' => $province->province_zoom,'center' => true, 'marker' => false, 'cluster' => true]);
        $areas = Area::where([['division_id','=',$divid],['province_id','=',$province->id]])->with('sites')->get();
        foreach ($areas as $area) {
            if ($area->has('sites')) {
                foreach ($area->sites as $site) {
                    $sitesId[] = $site->id;
                }
            }
        }
        $sitesCollection = Site::find($sitesId);
        $siteLocation = array();
        foreach ($sitesCollection as $site) {
            $siteLocation[] = [$site->site_name,$site->cor_x,$site->cor_y,$site->id,$divid,$pcode];
        }
        // $sitesCollection->each(function($site)
        // {
        //     Mapper::informationWindow($site->cor_x, $site->cor_y, $site->site_name, ['open' => true, 'maxWidth'=> 300, 'markers' => ['eventClick' => 'window.location.href = "/map/site/'.$site->id.'";']]);
        //     // Mapper::marker($site->cor_x, $site->cor_y,['eventClick' => 'window.location.href = "/map/site/'.$site->id.'";', 'eventMouseOver' => '']);
        // });
        $division = Division::find($sitesCollection[0]->division_id);
        return view('maps.prov',[
            'division' => $division,
            'prov' => $province,
            'siteLocation' => $siteLocation
        ]);
    }
    public function mapDivSite($divid,$pcode,$id)
    {
        $site = Site::find($id);
        Mapper::map($site->cor_x, $site->cor_y, ['zoom' => 18,'center' => true, 'marker' => false, 'cluster' => false, 'type' => 'SATELLITE']);
        $camsCollections = Cam::where('site_id',$site->id)->get();
        $camsLocation = array();
        $i = 1;
        $camsLocation[] = ["","","","",""];
        foreach ($camsCollections as $cam) {
            //$status = $this->healthCheck($cam->cam_ip_address);
            $camsLocation[] = [$cam->cam_name,$cam->cam_cor_x,$cam->cam_cor_y,$cam->cam_ip_address,$cam->id];
        }
        // $camsCollection->each(function($cam,$i)
        // {
        //     $content = '<h4>'.strtoupper($cam->cam_name).'</h4><p>IP Address: '.$cam->cam_ip_address.'</p>';
        //     Mapper::marker($cam->cam_cor_x, $cam->cam_cor_y, ['content' => $content,'icon' => ['url' => '/images/placeholder.svg','size' => 24],'eventMouseOver' => 'infowindow_'.$i.'.open(map, this);','eventMouseOut' => 'infowindow_'.$i.'.close(map, this);', 'eventClick' => 'showModal('.$cam->id.','.preg_replace("/\./", "",$cam->cam_ip_address).',"'.$cam->cam_name.'");' ]);
        //     // Mapper::informationWindow($cam->cam_cor_x, $cam->cam_cor_y, $content, ['maxWidth'=> 300, 'icon' => ['url' => '/images/placeholder.svg','size' => 24],'eventMouseOver' => 'infowindow.open(map, this);']);
        //     // Mapper::marker($cam->cam_cor_x, $cam->cam_cor_y,['icon' => ['url' => '/images/placeholder.svg','size' => 24],'eventMouseOver' => 'infowindow.open(map, this);']);
        //     // Mapper::marker($cam->cam_cor_x,$cam->cam_cor_y,['eventClick' => 'showModal();']);
        //     $i++;
        // });
        $area = Area::find($site->area_id);
        $prov = Province::find($area->province_id);
        $division = Division::find($area->division_id);
        return view('maps.site',[
            'division' => $division,
            'prov' => $prov,
            'site' => $site,
            // 'cams' => $camsCollection,
            'camsLocation' => $camsLocation
        ]);
    }

    public function healthCheck($ip)
    {
        $health = Ping::check($ip);

        if($health == 200) {
            return 'online';
        } else {
            return 'offline';
        }
    }

    // Run ffmpeg to grab image from cctv
    public function playCam($ip)
    {
        $vidDir = '/var/www/cctv/public/video/';
        $bash_commands = '
        while :
        do
        ffmpeg -y -rtsp_transport tcp -i rtsp://admin:FIW170845@'.$ip.':554/stream=2.sdp -vf scale=854:480 -r 2/1 -t 120 '.$vidDir.'ip-%01d.jpeg
        done';
        exec('rm '.$vidDir.'*');
        exec($bash_commands." > /dev/null 2>&1 & echo $!; ", $output);
        echo $pid;
        return 'running';
    }

    public function stopCam()
    {
        shell_exec('pkill ffmpeg');
        echo "done\n\n";
        exit();
    }

    public function checkDir()
    {
        $check = count(glob("/var/www/cctv/public/video/*")) == 0;
        if ($check) {
            return 'empty';
        } else {
            return 'exist';
        }
    }

    
}
