<?php
// user
Route::post('register', 'API\UserController@register');
Route::post('login', 'API\UserController@login');

// court
Route::get('courts', 'API\CourtController@index');

// court book
Route::post('court_book', 'API\CourtBookController@book');
Route::post('booking_list', 'API\CourtBookController@bookingList');

// request
Route::post('send_request', 'API\RequestController@sendRequest');
Route::post('requests', 'API\RequestController@requests');
Route::post('request_action', 'API\RequestController@requestAction');
