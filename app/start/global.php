<?php
/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/

use Iwo\Exceptions\CannotEditException;
use Iwo\Exceptions\UserNotFoundException;

ClassLoader::addDirectories(array(

	app_path().'/commands',
	app_path().'/controllers',
	app_path().'/models',
	app_path().'/database/seeds',

));

/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog library. By default we will
| build a basic log file setup which creates a single file for logs.
|
*/

Log::useFiles(storage_path().'/logs/laravel.log');

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/

App::error(function(Exception $exception, $code)
{
	Log::error($exception);
});

App::error(function(Iwo\Validation\FormValidationException $exception, $code)
{
	// Validation fails - go back to the form with errors and original input
	return Redirect::back()->withErrors($exception->getErrors())->withInput();
});

App::error(function(Iwo\FileUpload\FileUploadException $exception, $code)
{
	// Validation fails - go back to the form with errors and original input
	return Redirect::back()->withErrors($exception->getErrors())->withInput();
});

App::error(function(Iwo\Exceptions\ManagementLoginException $exception, $code)
{
    // Login fails - go back to the form with errors
    return Redirect::back()->withErrors($exception->getErrors());
});

App::error(function(Iwo\Exceptions\LoginFailedException $exception)
{
	Log::error($exception);

	return Redirect::back()->withInput()->withErrors('Incorrect login details entered. Please try again.');
});

App::error(function(UserNotFoundException $exception)
{
    Log::error($exception);
    return Redirect::route( 'users.index' )->withErrors($exception->getErrors());
});

App::error(function(CannotEditException $exception)
{
    Log::error($exception);
    return Redirect::route( 'users.index' )->withErrors($exception->getErrors());
});

/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenance mode is in effect for the application.
|
*/

App::down(function()
{
	return Response::make("The Fipra IWO system is down for maintenance. Please check back soon.", 503);
});

/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/

require app_path().'/filters.php';


/*
|--------------------------------------------------------------------------
| Custom validation rules
|--------------------------------------------------------------------------
|
| Register custom validation rules.
|
*/
Validator::resolver(function($translator, $data, $rules, $messages)
{
    return new Iwo\Validation\CustomValidator($translator, $data, $rules, $messages);
});
