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

Route::get('/','HomepageController@index')->name('homepage');
Route::prefix('map')->group(function () {
    Route::get('division/{id}', 'HomepageController@mapDiv')->name('map.division');
    Route::get('province/{pcode}', 'HomepageController@mapDivProvince')->name('map.province');
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
Route::prefix('site')->group(function () {
    Route::get('/', 'SiteController@index')->name('site.index');
    Route::get('/create', 'SiteController@create')->name('site.create');
    Route::post('create', 'SiteController@store')->name('site.store');
    Route::get('edit/{id}', 'SiteController@edit')->name('site.edit');
    Route::put('edit/{id}', 'SiteController@editStore')->name('site.editStore');
    Route::delete('delete/{id}', 'SiteController@destroy')->name('site.destroy');
});
