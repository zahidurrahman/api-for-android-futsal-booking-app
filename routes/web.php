<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/show_court', function () {
    return view('view_court');
});

Route::post('/add_court','HomeController@add_court')->name('add_court');

Route::get('/edit_court', function () {
    return view('edit_court');
});
Route::post('/update_court','HomeController@update_court')->name('update_court');
Route::post('/del_court','HomeController@destroy_court')->name('destroy_court');
//--------------------------- booking ------------------------------------
Route::get('/view_booking', function () {
    return view('view_booking');
});

Route::post('/del_booking','HomeController@destroy_booking')->name('destroy_booking');