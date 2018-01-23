<?php

// Temporary Peter-Carlo Lehrell IWOs listing page
Route::get('pcl', 'AdminController@getPcl');

//Temporary login access code check

Route::get('/login', function()
{
	return Redirect::to('/');
    return View::make('login')->with('page_title', 'Please Login: Online Internal Work Order');
});

Route::post('/login', function()
{
    if( Input::get('access_code') != 'fipra2016fipra')
    {
        Session::flash('msg', 'Incorrect access code. Please try again.');
        
        return Redirect::to('login');
    }
    else {
        Session::put('loggedin', 'yes');
        return Redirect::to('/');
    }
});

Route::get('/logout', function()
{
    Session::forget('loggedin');
    Session::put('msg', 'You have been logged out.');
    return Redirect::to('login');
});


Route::group(['before' => 'access_check'], function()
{
    Route::controller('edt', 'EDTWorkOrderController');
    Route::controller('unit', 'UnitWorkOrderController');
    Route::controller('spad', 'SpadWorkOrderController');
    Route::controller('fiplex', 'FiplexWorkOrderController');
    Route::controller('fiptalk', 'FiptalkWorkOrderController');

    Route::when('*/save', 'input_exists');
    Route::when('manage/update', 'input_exists');

    Route::controller('manage', 'ManagementController');
    Route::when('manage/*', 'auth');

    Route::controller('admin', 'AdminController');
//Route::when('admin/*', 'auth_superuser');

    Route::get('about/edt', 'PagesController@about_edt');
    Route::get('about/fiplex', 'PagesController@about_fiplex');



    Route::get('/', ['as' => 'home', function()
    {
        return View::make('home')->with('page_title', 'Online Internal Work Order');
    }]);

    Route::get('complete', ['as' => 'complete', function()
    {
        return View::make('complete')->with('page_title', 'Work Order Submitted');
    }]);

});

Route::post('queue/push', function()
{
    Log::info('marshal!');
    return Queue::marshal();
});

Route::controller('confirm', 'ConfirmController');

Route::get('error', 'PagesController@error');
Route::get('success', 'PagesController@success');

//Account Director autocomplete
Route::get('ac/account_directors', 'AutocompleteController@account_directors');
//Unit reps autocomplete
Route::get('ac/unit_reps', 'AutocompleteController@unit_reps');
//Spad reps autocomplete
Route::get('ac/spad_reps', 'AutocompleteController@spad_reps');
//Unit lead contacts/reps autocomplete
Route::get('ac/unit_lead_contacts_and_reps', 'AutocompleteController@unit_lead_contacts_and_reps');
//Unit lead contacts/reps dropdown autofill
Route::get('ac/unit_dropdown', 'AutocompleteController@unit_dropdown');