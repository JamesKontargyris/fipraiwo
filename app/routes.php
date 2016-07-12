<?php

Route::get('/adduser', function()
{
//    $me = User::where('email','=','james.kontargyris@fipra.com')->where('password', '<>', '')->first();
//    $me->roles()->attach(5);

});

Route::get('/logout', function()
{
    Auth::logout();
    return Redirect::to('login');
});


//Login / logout
//Route::post('manage/login', 'ManagementController@login');
Route::controller('login', 'LoginController');

Route::group(['before' => 'auth'], function()
{
    Route::when('*/save', 'input_exists');
    Route::when('manage/update', 'input_exists');

    Route::controller('manage', 'ManagementController');
    Route::when('manage/*', 'auth');

    Route::controller('admin', 'AdminController');
//Route::when('admin/*', 'auth_superuser');

    Route::get('about/edt', 'PagesController@about_edt');
    Route::get('about/fiplex', 'PagesController@about_fiplex');

});

Route::group(['before' => ['auth', 'is_managing']], function ()
{
    Route::controller('edt', 'EDTWorkOrderController');
    Route::controller('unit', 'UnitWorkOrderController');
    Route::controller('spad', 'SpadWorkOrderController');
    Route::controller('fiplex', 'FiplexWorkOrderController');
    Route::controller('fiptalk', 'FiptalkWorkOrderController');

    Route::get('complete', ['as' => 'complete', function()
    {
        return View::make('complete')->with('page_title', 'Work Order Submitted');
    }]);
    Route::get('/', ['as' => 'home', function()
    {
        return View::make('home')->with('page_title', 'Online Internal Work Order');
    }]);
});

//Confirmation route must be outside the access_check filter
Route::controller('confirm', 'ConfirmController');

//Mail queue route
Route::post('queue/push', function()
{
    Log::info('marshal!');
    return Queue::marshal();
});

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