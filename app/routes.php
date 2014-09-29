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

Route::get('test', function()
{
});

Route::get('updaterepemails', function()
{
	//$iwos = Workorder::all();
	//$count = 0;
	//foreach($iwos as $iwo)
	//{
	//	$workorder = unserialize($iwo->workorder);
	//	if(isset($workorder['lead_fipra_representative']))
	//	{
	//		$email = Rep_email::where('rep_name', $workorder['lead_fipra_representative'])->pluck('rep_email');
	//		$count++;
	//		var_dump($email);
	//
	//		if($email != NULL)
	//		{
	//			$new_user = new User;
	//			$new_user->email = trim($email);
	//			$new_user->name = $workorder['lead_fipra_representative'] . ' (Lead Rep)';
	//			$new_user->iwo_id = $iwo->id;
	//			$new_user->save();
	//
	//			$new_user->attachRole(Role::where('name', 'Viewer')->pluck('id'));
	//		}
	//	}
	//
	//	if(isset($workorder['sub_fipra_representative']))
	//	{
	//		$email = Rep_email::where('rep_name', $workorder['sub_fipra_representative'])->pluck('rep_email');
	//		$count++;
	//		var_dump($email);
	//
	//		if($email != NULL)
	//		{
	//			$new_user = new User;
	//			$new_user->email = trim($email);
	//			$new_user->name = $workorder['sub_fipra_representative'] . ' (Sub Rep)';
	//			$new_user->iwo_id = $iwo->id;
	//			$new_user->save();
	//
	//			$new_user->attachRole(Role::where('name', 'Viewer')->pluck('id'));
	//		}
	//	}
	//}
	//
	//return "All done! " . $count . " users created.";
});

//Account Director autocomplete
Route::get('ac/account_directors', 'AutocompleteController@account_directors');
//Unit reps autocomplete
Route::get('ac/unit_reps', 'AutocompleteController@unit_reps');
//Spad reps autocomplete
Route::get('ac/spad_reps', 'AutocompleteController@spad_reps');
//Unit lead contacts/reps autocomplete
Route::get('ac/unit_lead_contacts_and_reps', 'AutocompleteController@unit_lead_contacts_and_reps');