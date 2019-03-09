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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Categories Route
Route::get('categories', 'CategoryController@index');
// Insert
Route::get('categories/create', 'CategoryController@create');
Route::post('categories', 'CategoryController@store');
// Details
Route::get('categories/{id}', 'CategoryController@detail');
// Details -> Edit
Route::get('categories/{id}/edit', 'CategoryController@edit');
Route::patch('categories/{id}', 'CategoryController@update');
// Details -> Delete
Route::delete('categories/{id}', 'CategoryController@destroy');

// Rooms Route
Route::get('rooms', 'RoomController@index');