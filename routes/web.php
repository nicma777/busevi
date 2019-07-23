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


Auth::routes();

Route::get('/test', function (){
   return bcrypt('123456789');
});

Route::get('/dashboard', 'c@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');

Route::resource('arrival', 'ArivalController');
Route::resource('departure', 'DepartureController');

