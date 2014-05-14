<?php

Route::controller('edt', 'EDTWorkOrderController');
Route::controller('unit', 'UnitWorkOrderController');
Route::controller('spad', 'SpadWorkOrderController');
Route::controller('fiplex', 'FiplexWorkOrderController');

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

