<?php

Route::controller('edt', 'EDTWorkOrderController');
Route::controller('unit', 'UnitWorkOrderController');
Route::controller('spad', 'SpadWorkOrderController');
Route::controller('fiplex', 'FiplexWorkOrderController');
Route::controller('fiptalk', 'FiptalkWorkOrderController');

Route::get('/addperms', function()
{

});

Route::when('*/save', 'input_exists');

Route::controller('manage', 'ManagementController');
Route::when('manage/*', 'auth');

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