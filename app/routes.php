<?php

Route::get('/addmasteruser', function()
{
    $user = new User;
    $user->email = 'james.kontargyris@fipra.com';
    $user->name = 'James Kontargyris';
    $user->password = Hash::make('kontargyris');
    $user->iwo_id = 999999;

    $fipriot = new Role;
    $fipriot->name = 'Fipriot';
    $fipriot->save();

    $admin = new Role;
    $admin->name = 'Administrator';
    $admin->save();

    $isadmin = new Permission;
    $isadmin->name = 'is_admin';
    $isadmin->display_name = 'Is an Admin';
    $isadmin->save();

    $wo = new Workorder; $wo->id = 999999; $wo->workorder = '0'; $wo->title = "Blank Workorder"; $wo->expiry_date = '2999-01-01'; $wo->formtype_id = 1; $wo->save();

    $adminrole = Role::where('name','=','Administrator')->get()->first();
    $adminrole->attachPermission(Permission::where('name', '=', 'is_admin')->get()->first()->id);

    $user = new User; $user->email = 'james.kontargyris@fipra.com'; $user->name = 'James Kontargyris'; $user->password = Hash::make('kontargyris'); $user->iwo_id = 999999; $user->changed_password = 0; $user->save(); $user->attachRole(Role::where('name','=','Administrator')->get()->first()->id);

});

Route::get('/logout', function()
{
    Auth::logout();
    return Redirect::to('login')->with('message', 'You have been logged out.');
});


//Login / logout
//Route::post('manage/login', 'ManagementController@login');
Route::controller('login', 'LoginController');

Route::group(['before' => 'auth'], function()
{
    Route::get('password/change', 'PasswordController@getChange');
    Route::post('password/change', 'PasswordController@postChange');

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

Route::group(['before' => 'is_admin'], function()
{
   Route::resource('users', 'UserController');
});

Route::controller('password', 'PasswordController');

//Confirmation route must be outside the access_check filter
Route::controller('confirm', 'ConfirmController');

//Error and success message views
Route::get('error', 'PagesController@error');
Route::get('success', 'PagesController@success');

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