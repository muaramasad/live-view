<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('area/{id}','SiteController@getAreaByDivision');
Route::get('division/{idDiv}','SiteController@getSiteByDivision');
Route::get('division/{idDiv}/{idArea}','SiteController@getSiteByDivisionArea');

// API For User Create and Edit Page
Route::get('area','UserController@getAreaByDivisionUser');

// API CCTV
Route::get('cctv/status/{ip}','HomepageController@healthCheck');
Route::get('cctv/play/{ip}','HomepageController@playCam');
Route::get('cctv/stop/{pid}','HomepageController@stopCam');
Route::get('cctv/checkdir','HomepageController@checkDir');