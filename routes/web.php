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
// Create
Route::get('categories/create', 'CategoryController@create');
Route::post('categories', 'CategoryController@store');
// Detail
Route::get('categories/{id}', 'CategoryController@detail');
// Detail -> Edit
Route::get('categories/{id}/edit', 'CategoryController@edit');
Route::patch('categories/{id}', 'CategoryController@update');
// Detail -> Delete
Route::delete('categories/{id}', 'CategoryController@destroy');

// Rooms Route
Route::get('rooms', 'RoomController@index');
// Create
Route::get('rooms/create', 'RoomController@create');
Route::post('rooms', 'RoomController@store');
// Detail
Route::get('rooms/{id}', 'RoomController@detail');
// Detail -> Edit
Route::get('rooms/{id}/update', 'RoomController@edit');
Route::patch('rooms/{id}', 'RoomController@update');

// Detail -> Status
Route::post('rooms/{roomId}/booking', 'RoomStatusController@store');
Route::post('rooms/{roomId}/unavailable', 'RoomController@unavailable');
Route::post('rooms/{roomId}/checkin', 'RoomStatusController@checkin');
Route::post('rooms/{roomId}/checkout', 'RoomStatusController@checkout');
Route::post('rooms/{roomId}/available', 'RoomStatusController@available');
Route::post('rooms/{roomId}/onservice', 'RoomStatusController@onservice');
// Detail -> Delete
Route::delete('rooms/{id}', 'RoomController@destroy');