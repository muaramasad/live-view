<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['middleware' => 'auth'])->group(function () {
Route::get('/','HomepageController@index')->name('homepage');
Route::prefix('map')->group(function () {
    Route::get('division/{id}', 'HomepageController@mapDiv')->name('map.division');
    Route::get('province/{pcode}', 'HomepageController@mapDivProvince')->name('map.province');
    Route::get('site/{id}', 'HomepageController@mapDivSite')->name('map.site');
});

Route::prefix('division')->group(function () {
    Route::get('/', 'DivisionController@index')->name('division.index');
    Route::get('create', 'DivisionController@create')->name('division.create');
    Route::post('create', 'DivisionController@store')->name('division.store');
    Route::get('edit/{id}', 'DivisionController@edit')->name('division.edit');
    Route::put('edit/{id}', 'DivisionController@editStore')->name('division.editStore');
    Route::delete('delete/{id}', 'DivisionController@destroy')->name('division.destroy');
});

Route::prefix('area')->group(function () {
    Route::get('/', 'AreaController@index')->name('area.index');
    Route::get('/create', 'AreaController@create')->name('area.create');
    Route::post('create', 'AreaController@store')->name('area.store');
    Route::get('edit/{id}', 'AreaController@edit')->name('area.edit');
    Route::put('edit/{id}', 'AreaController@editStore')->name('area.editStore');
    Route::delete('delete/{id}', 'AreaController@destroy')->name('area.destroy');
});

Route::prefix('role')->group(function () {
    Route::get('/', 'RoleController@index')->name('role.index');
    Route::get('/create', 'RoleController@create')->name('role.create');
    Route::post('create', 'RoleController@store')->name('role.store');
    Route::get('edit/{id}', 'RoleController@edit')->name('role.edit');
    Route::put('edit/{id}', 'RoleController@editStore')->name('role.editStore');
    Route::delete('delete/{id}', 'SiteController@destroy')->name('role.destroy');
});

Route::prefix('permission')->group(function () {
    Route::get('/', 'PermissionController@index')->name('permission.index');
    Route::get('/create', 'PermissionController@create')->name('permission.create');
    Route::post('create', 'PermissionController@store')->name('permission.store');
    Route::get('edit/{id}', 'PermissionController@edit')->name('permission.edit');
    Route::put('edit/{id}', 'PermissionController@editStore')->name('permission.editStore');
    Route::delete('delete/{id}', 'SiteController@destroy')->name('permission.destroy');
});

Route::prefix('site')->group(function () {
    Route::get('/', 'SiteController@index')->name('site.index');
    Route::get('/create', 'SiteController@create')->name('site.create');
    Route::post('create', 'SiteController@store')->name('site.store');
    Route::get('edit/{id}', 'SiteController@edit')->name('site.edit');
    Route::put('edit/{id}', 'SiteController@editStore')->name('site.editStore');
    Route::delete('delete/{id}', 'SiteController@destroy')->name('site.destroy');
});

Route::prefix('cctv')->group(function () {
    Route::get('/', 'CamController@index')->name('cam.index');
    Route::get('/create/site/{id}', 'CamController@create')->name('cam.create');
    Route::post('create', 'CamController@store')->name('cam.store');
    Route::get('edit/{id}/site/{siteId}', 'CamController@edit')->name('cam.edit');
    Route::put('edit/{id}', 'CamController@editStore')->name('cam.editStore');
    Route::delete('delete/{id}', 'CamController@destroy')->name('cam.destroy');
    //View CCTV by Site ID
    Route::get('/site/{id}', 'CamController@listBySiteId')->name('cam.listBySite');
});

Route::resource('user', 'UserController');
});
Auth::routes();