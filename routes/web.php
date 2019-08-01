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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/welcome', function () {
    return view('welcome');
});

//route to show members by agents

Route::get('/girl', 'Controller@member');
Route::get('/test', 'TrialController@test');



Route::get('/chart2', 'PostsController@chart2');

Route::get('/high', 'TrialController@select');


Route::get('/hig', 'PostsController@makeChart2');

Route::get('/upgrade', 'PostsController@upgrade');





Route::get('/new', function () {
    return view('new');
});

Route::get('/trial', 'TrialController@select');



//route to show members by district
Route::get('/bydistrict', 'Controller@showmembers');

Route::get('/registerDistrict', 'PostsController@create'); 
Route::get('/registerAgent', 'PostsController@agent');   
Route::get('/donation', 'PostsController@donate');
Route::post('/mime', 'PostsController@store');
Route::post('/second', 'PostsController@store2');
Route::post('/third', 'PostsController@store3');
Route::get('/dontable', 'PostsController@donate2');
Route::get('/agents', 'PostsController@agents');
Route::get('/charts', 'PostsController@charts');

Route::get('/member', 'PostsController@member');


Route::get('/newly', 'PostsController@makeChart');

Route::get('/chart3', 'PostsController@makeChart2');



Route::get('/tables', 'Controller@getdistrict');
Route::get('/dontable', 'Controller@getdonation');
Route::get('/payment', 'TrialController@pay2');

Route::get('/agents', 'Controller@agents');
Route::get('/new', 'PostsController@seecharts');

Route::get('/else','PostsController@seecharts');

Auth::routes();

Route::get('/blank', 'HomeController@index')->name('blank');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

