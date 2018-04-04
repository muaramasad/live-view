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
Route::prefix('dashboard')->group(function () {
    Route::get('division/{id}', 'HomepageController@mapDiv')->name('dashboard.division');
    Route::get('division/{divid}/province/{pcode}', 'HomepageController@mapDivProvince')->name('dashboard.province');
    Route::get('division/{divid}/province/{pcode}/site/{id}', 'HomepageController@mapDivSite')->name('dashboard.site');
    Route::get('settings', 'HomepageController@settings' )->name('dashboard.settings');
    Route::post('settings', 'HomepageController@settingsChangePassword' )->name('dashboard.settingsChangePassword');
});

Route::prefix('division')->group(function () {
    Route::get('/', 'DivisionController@index')->name('division.index')->middleware('permission:division.index');
    Route::get('create', 'DivisionController@create')->name('division.create')->middleware('permission:division.create');
    Route::post('create', 'DivisionController@store')->name('division.store');
    Route::get('edit/{id}', 'DivisionController@edit')->name('division.edit')->middleware('permission:division.edit');;
    Route::put('edit/{id}', 'DivisionController@editStore')->name('division.editStore');
    Route::delete('delete/{id}', 'DivisionController@destroy')->name('division.destroy')->middleware('permission:division.destroy');
});

Route::prefix('area')->group(function () {
    Route::get('/', 'AreaController@index')->name('area.index')->middleware('permission:area.index');
    Route::get('/create', 'AreaController@create')->name('area.create')->middleware('permission:area.create');
    Route::post('create', 'AreaController@store')->name('area.store');
    Route::get('edit/{id}', 'AreaController@edit')->name('area.edit')->middleware('permission:area.edit');
    Route::put('edit/{id}', 'AreaController@editStore')->name('area.editStore');
    Route::delete('delete/{id}', 'AreaController@destroy')->name('area.destroy')->middleware('permission:area.destroy');
});

Route::prefix('role')->group(function () {
    Route::get('/', 'RoleController@index')->name('role.index')->middleware('permission:role.index');
    Route::get('/create', 'RoleController@create')->name('role.create')->middleware('permission:role.create');
    Route::post('create', 'RoleController@store')->name('role.store');
    Route::get('edit/{id}', 'RoleController@edit')->name('role.edit')->middleware('permission:role.edit');
    Route::put('edit/{id}', 'RoleController@editStore')->name('role.editStore');
    Route::delete('delete/{id}', 'RoleController@destroy')->name('role.destroy')->middleware('permission:role.destroy');
});

Route::prefix('permission')->group(function () {
    Route::get('/', 'PermissionController@index')->name('permission.index')->middleware('permission:permission.index');
    Route::get('/create', 'PermissionController@create')->name('permission.create')->middleware('permission:permission.create');
    Route::post('create', 'PermissionController@store')->name('permission.store');
    Route::get('edit/{id}', 'PermissionController@edit')->name('permission.edit')->middleware('permission:permission.edit');
    Route::put('edit/{id}', 'PermissionController@editStore')->name('permission.editStore');
    Route::delete('delete/{id}', 'PermissionController@destroy')->name('permission.destroy')->middleware('permission:permission.destroy');
});

Route::prefix('site')->group(function () {
    Route::get('/', 'SiteController@index')->name('site.index')->middleware('permission:site.index');
    Route::get('/create', 'SiteController@create')->name('site.create')->middleware('permission:site.create');
    Route::post('create', 'SiteController@store')->name('site.store');
    Route::get('edit/{id}', 'SiteController@edit')->name('site.edit')->middleware('permission:permission.edit');
    Route::put('edit/{id}', 'SiteController@editStore')->name('site.editStore');
    Route::delete('delete/{id}', 'SiteController@destroy')->name('site.destroy')->middleware('permission:permission.destroy');
});

Route::prefix('cctv')->group(function () {
    Route::get('/', 'CamController@index');
    Route::get('/create/site/{id}', 'CamController@create')->name('cam.create')->middleware('permission:cam.create');
    Route::post('create', 'CamController@store')->name('cam.store');
    Route::get('edit/{id}/site/{siteId}', 'CamController@edit')->name('cam.edit')->middleware('permission:cam.edit');
    Route::put('edit/{id}', 'CamController@editStore')->name('cam.editStore');
    Route::delete('delete/{id}', 'CamController@destroy')->name('cam.destroy')->middleware('permission:cam.destroy');
    //View CCTV by Site ID
    Route::get('/site/{id}', 'CamController@listBySiteId')->name('cam.listBySite')->middleware('permission:cam.listBySite');
});

Route::resource('user', 'UserController')->names(['index' => 'user.index'])
     ->middleware(['permission:user.index']);
Route::resource('user', 'UserController')->names(['create' => 'user.create'])
     ->middleware(['permission:user.create']);
Route::resource('user', 'UserController')->names(['edit' => 'user.edit'])
     ->middleware(['permission:user.edit']);
Route::resource('user', 'UserController')->names(['destroy' => 'user.destroy'])
     ->middleware(['permission:user.destroy']);
});
Auth::routes();