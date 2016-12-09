<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('', array('as' => 'homepage', 'uses' => 'PageControl@index'));


Auth::routes();



Route::get('admin/home', array('as' => 'home', 'uses' => 'HomeController@index'));

Route::get('admin/show/{page}', array('uses' => 'Cms\backend@show'));

Route::get("admin/delete/{id}", array('as' => 'delete', 'uses' => 'Cms\backend@delete'));
Route::get("admin/edit/deleteImage/{id}", array('uses' => 'Cms\backend@deleteImage'));
Route::get("admin/edit/{id}", array('as' => 'edit', 'uses' => 'Cms\backend@edit'));
Route::post("admin/update/{id}", array('as' => 'update', 'uses' => 'Cms\backend@update'));
Route::post("admin/save", array('uses' =>"Cms\Backend@save"));

Route::get('/{any}', array('as' => 'openPage', 'uses' => 'PageControl@open'));