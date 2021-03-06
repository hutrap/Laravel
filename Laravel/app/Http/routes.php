<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/Comment', function() {
// Does not work for 5
//    View::make('comment'); // will return app/views/index.php
    return view('comment');
});

Route::get('/RotaSlot', function() {
// Does not work for 5
//    View::make('comment'); // will return app/views/index.php
    return view('rotaSlotStaff');
});


Route::get('/Test/xml', 'TestController@getXml');
Route::get('/Test/json', 'TestController@getJson');


// API ROUTES ==================================
Route::group(array('prefix' => 'api'), function() {

    // since we will be using this just for CRUD, we won't need create and edit
    // Angular will handle both of those forms
    // this ensures that a user can't access api/create or api/edit when there's nothing there
    Route::resource('comments', 'CommentController',
        array('only' => array('index', 'store', 'destroy')));

    Route::resource('rotaSlot', 'RotaSlotStaffController',
        array('only' => array('index')));

});

