<?php

use Illuminate\Database\Seeder;

class ProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //delete users table records
         DB::table('provinces')->delete();
         //insert some dummy records
         DB::table('provinces')->insert(array(
             array('province_name'=>'Aceh','province_code'=>'ID-AC','province_cor_x'=>'4.0','province_cor_y'=>'97.0', 'province_zoom' => '8'),
             array('province_name'=>'Sumatera Utara','province_code'=>'ID-SU','province_cor_x'=>'2.0','province_cor_y'=>'99.0', 'province_zoom' => '8'),
             array('province_name'=>'Riau','province_code'=>'ID-RI','province_cor_x'=>'0.5005','province_cor_y'=>'101.749', 'province_zoom' => '8'),
             array('province_name'=>'Kepulauan Riau','province_code'=>'ID-KR','province_cor_x'=>'0.61667','province_cor_y'=>'106.98333', 'province_zoom' => '8', 'province_zoom' => '8'),
             array('province_name'=>'Sumatera Barat','province_code'=>'ID-SB','province_cor_x'=>'-1.0','province_cor_y'=>'100.5', 'province_zoom' => '8'),
             array('province_name'=>'Jambi','province_code'=>'ID-JA','province_cor_x'=>'-3.7','province_cor_y'=>'103.0', 'province_zoom' => '8'),
             array('province_name'=>'Bengkulu','province_code'=>'ID-BE','province_cor_x'=>'-3.7','province_cor_y'=>'102.2', 'province_zoom' => '8'),
             array('province_name'=>'Sumatera Selatan','province_code'=>'ID-SS','province_cor_x'=>'-2.75','province_cor_y'=>'103.83333', 'province_zoom' => '8'),
             array('province_name'=>'Lampung','province_code'=>'ID-LA','province_cor_x'=>'-5.0','province_cor_y'=>'105.0', 'province_zoom' => '8'),
             array('province_name'=>'Bangka Belitung','province_code'=>'ID-BB','province_cor_x'=>'-2.66667','province_cor_y'=>'106.66667', 'province_zoom' => '8'),
             array('province_name'=>'Banten','province_code'=>'ID-BT','province_cor_x'=>'-6.5','province_cor_y'=>'106.25', 'province_zoom' => '8'),
             array('province_name'=>'DKI Jakarta','province_code'=>'ID-JK','province_cor_x'=>'-6.2182','province_cor_y'=>'106.8584', 'province_zoom' => '8'),
             array('province_name'=>'Jawa Barat','province_code'=>'ID-JB','province_cor_x'=>'-6.75','province_cor_y'=>'107.5', 'province_zoom' => '8'),
             array('province_name'=>'Jawa Tengah','province_code'=>'ID-JT','province_cor_x'=>'-7.5','province_cor_y'=>'110.0', 'province_zoom' => '8'),
             array('province_name'=>'Yogyakarta','province_code'=>'ID-YO','province_cor_x'=>'-7.75','province_cor_y'=>'110.5', 'province_zoom' => '7'),
             array('province_name'=>'Jawa Timur','province_code'=>'ID-JI','province_cor_x'=>'-7.7394','province_cor_y'=>'112.5099', 'province_zoom' => '8'),
             array('province_name'=>'Kalimantan Barat','province_code'=>'ID-KB','province_cor_x'=>'0.0','province_cor_y'=>'110.5', 'province_zoom' => '7'),
             array('province_name'=>'Kalimantan Tengah','province_code'=>'ID-KT','province_cor_x'=>'-2.0','province_cor_y'=>'113.5', 'province_zoom' => '7'),
             array('province_name'=>'Kalimantan Selatan','province_code'=>'ID-KS','province_cor_x'=>'-2.5','province_cor_y'=>'115.5', 'province_zoom' => '8'),
             array('province_name'=>'Kalimantan Timur','province_code'=>'ID-KT','province_cor_x'=>'0.5','province_cor_y'=>'116.5', 'province_zoom' => '7'),
             array('province_name'=>'Kalimantan Utara','province_code'=>'ID-KU','province_cor_x'=>'3.35989','province_cor_y'=>'116.53198', 'province_zoom' => '7'),
             array('province_name'=>'Bali','province_code'=>'ID-BI','province_cor_x'=>'-8.5','province_cor_y'=>'115.0', 'province_zoom' => '10'),
             array('province_name'=>'Nusa Tenggara Barat','province_code'=>'ID-BA','province_cor_x'=>'-8.74','province_cor_y'=>'117.5333', 'province_zoom' => '9'),
             array('province_name'=>'Nusa Tenggara Timur','province_code'=>'ID-NT','province_cor_x'=>'-8.65738','province_cor_y'=>'121.07937', 'province_zoom' => '8'),
             array('province_name'=>'Sulawesi Barat','province_code'=>'ID-SR','province_cor_x'=>'-2.5','province_cor_y'=>'119.3333', 'province_zoom' => '8'),
             array('province_name'=>'Sulawesi Selatan','province_code'=>'ID-SN','province_cor_x'=>'-4.33333','province_cor_y'=>'120.25', 'province_zoom' => '7'),
             array('province_name'=>'Sulawesi Tenggara','province_code'=>'ID-SG','province_cor_x'=>'-4.3935','province_cor_y'=>'122.2149', 'province_zoom' => '8'),
             array('province_name'=>'Sulawesi Tengah','province_code'=>'ID-ST','province_cor_x'=>'-0.9166','province_cor_y'=>'122.3538', 'province_zoom' => '7'),
             array('province_name'=>'Sulawesi Utara','province_code'=>'ID-SA','province_cor_x'=>'1.25','province_cor_y'=>'124.83333', 'province_zoom' => '7'),
             array('province_name'=>'Gorontalo','province_code'=>'ID-GO','province_cor_x'=>'0.693','province_cor_y'=>'122.4704', 'province_zoom' => '8'),
             array('province_name'=>'Maluku','province_code'=>'ID-MA','province_cor_x'=>'-3.23846','province_cor_y'=>'130.14527', 'province_zoom' => '7'),
             array('province_name'=>'Maluku Utara','province_code'=>'ID-MU','province_cor_x'=>'-0.25','province_cor_y'=>'127.5', 'province_zoom' => '7'),
             array('province_name'=>'Papua Barat','province_code'=>'ID-PB','province_cor_x'=>'-0.86531','province_cor_y'=>'134.06118', 'province_zoom' => '7'),
             array('province_name'=>'Papua','province_code'=>'ID-PA','province_cor_x'=>'-4.75','province_cor_y'=>'138.0', 'province_zoom' => '6'),
          ));
    }
}
