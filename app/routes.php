<?php

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

Route::controller('confirm', 'ConfirmController');

Route::get('about/edt', 'PagesController@about_edt');
Route::get('about/fiplex', 'PagesController@about_fiplex');

Route::post('queue/push', function()
{
	return Queue::marshal();
});

Route::get('/', ['as' => 'home', function()
{
	return View::make('home')->with('page_title', 'Online Internal Work Order');
}]);

Route::get('complete', ['as' => 'complete', function()
{
	return View::make('complete')->with('page_title', 'Work Order Submitted');
}]);

Route::get('add_roles_and_perms', function()
{
    $lead = Role::find(1);

    $sub = Role::find(2);

    $read = new Permission();
    $read->name = 'read';
    $read->display_name = "Can Read IWOs";
    $read->save();

    $lead->attachPermission($read);

    $sub->attachPermission($read);

    return "Done.";
});


//Account Director autocomplete
Route::get('ac/account_directors', 'AutocompleteController@account_directors');
//Unit reps autocomplete
Route::get('ac/unit_reps', 'AutocompleteController@unit_reps');
//Spad reps autocomplete
Route::get('ac/spad_reps', 'AutocompleteController@spad_reps');