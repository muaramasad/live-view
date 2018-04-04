<?php

namespace App\Http\Controllers;

use Symfony\Component\Process\PhpProcess;
use App\Http\Requests\StoreVideoRequest;
use App\Jobs\ConvertVideoForStreaming;
use File;
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
use Auth;
use Illuminate\Support\Facades\Storage;


class HomepageController extends Controller
{
    public function index()
    {
        $userDivs = array();
        foreach(Auth::user()->division as $value){
            $userDivs[] = $value->id;
        }
        $divisions = Division::whereIn('id',  $userDivs)->orderBy('division_name', 'asc')->get();
        return view('homepage',[
            'divisions' => $divisions
        ]);
    }
    public function mapDiv($id)
    {
        $userAreas = array();
        foreach(Auth::user()->area as $value){
            $userAreas[] = $value->id;
        }
        $provinceId = [];
        $division = Division::find($id);
        $sites = Site::where('division_id',$id)->get();
        $areas = Area::where('division_id',$id)->whereIn('id',  $userAreas)->with('province')->get();
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
        return view('maps.div',[
            'areas' => $areas,
            'division' => $division,
            'sites' => $sites,
            'divLocation' => $divLocation
        ]);
    }
    public function mapDivProvince($divid, $pcode)
    {
        $userSites = array();
        foreach(Auth::user()->site as $value){
            $userSites[] = $value->id;
        }
        $sitesId = [];
        $province = Province::where('province_code',$pcode)->first();
        // Mapper::map($province->province_cor_x, $province->province_cor_y, ['zoom' => $province->province_zoom,'center' => true, 'marker' => false, 'cluster' => true]);
        $areas = Area::where([['division_id','=',$divid],['province_id','=',$province->id]])->with('sites')->get();
        foreach ($areas as $area) {
            if ($area->has('sites')) {
                foreach ($area->sites as $site) {
                    if (in_array($site->id, $userSites)) {
                        $sitesId[] = $site->id;
                    }
                }
            }
        }
        $sitesCollection = Site::find($sitesId);
        $siteLocation = array();
        foreach ($sitesCollection as $site) {
            $siteLocation[] = [$site->site_name,$site->cor_x,$site->cor_y,$site->id,$divid,$pcode];
        }
        $division = Division::find($sitesCollection[0]->division_id);
        return view('maps.prov',[
            'division' => $division,
            'prov' => $province,
            'siteLocation' => $siteLocation
        ]);
    }
    public function mapDivSite(Request $request,$divid,$pcode,$id)
    {
        $userSites = array();
        foreach(Auth::user()->site as $value){
            $userSites[] = $value->id;
        }
        if(in_array($id, $userSites)){
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
        } else {
            $request->session()->flash('is-danger', 'Access Denied!');
            return redirect()->route('homepage');
        }
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
        $dataPlay = array();
        $randomFolder = rand(1000, 9999);
        $vidDir = '/var/www/cctv/public/video/'.$randomFolder.'/';
        exec('mkdir '.$vidDir);
        $bash_commands = '
        while :
        do
        ffmpeg -y -rtsp_transport tcp -i rtsp://admin:FIW170845@'.$ip.':554/stream=2.sdp -vf scale=854:480 -r 3/1 -t 120 '.$vidDir.'ip-%01d.jpeg
        done';
        // exec('rm -rf'.$vidDir);
        $pid = exec($bash_commands.' > /dev/null 2>&1 & echo $!; ', $output);
        $dataPlay = [0 => $pid, 1 => $randomFolder, 2 => $ip];
        return $dataPlay;
    }

    public function stopCam($pid,$folder,$ip)
    {
    $answer = system("pgrep -a ffmpeg | grep ".$ip);
        $ffmpegPid = substr($answer, 0, strpos($answer, ' '));
        shell_exec('kill '.$pid);
        shell_exec('kill '.$ffmpegPid);
        $vidDir = "/var/www/cctv/public/video/".$folder.'/';
        $del = File::deleteDirectory($vidDir);
        //exec('rm -rf'.$vidDir);
        return 'stoped';
        exit();
    }

    public function checkDir($folder)
    {
        $check = count(glob("/var/www/cctv/public/video/".$folder."/*")) == 0;
        if ($check) {
            return 'empty';
        } else {
            return 'exist';
        }
    }

}