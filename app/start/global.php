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
| build a rotating log file setup which creates a new file each day.
|
*/

$logFile = 'log-'.php_sapi_name().'.txt';

Log::useDailyFiles(storage_path().'/logs/'.$logFile);

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
  return Response::view('errors.error_500', array(), 500);
});

App::missing(function($exception)
{
  Log::error("404 error: " . Request::URL());
  return Response::view('errors.error_404', array(), 404);
});


/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenace mode is in effect for this application.
|
*/

App::down(function()
{
	return Response::make("Be right back!", 503);
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

Password::validator(function($credentials)
{
  return strlen($credentials['password']) >= 8;
});

User::saving(function($user)
{
  $original = $user->getOriginal();
  $attributes = $user->getAttributes();

  // send the email alert to users if previous version wasn't published and this version is 
  if (!empty($original) and $original['role'] === 'PENDING' and $attributes['role'] === 'USER')
  {
    if ($attributes['innovator'])
    {
      Mail::send('emails.innovator_approved_email', [], function($message) use ($user)
      {
        $message->to($user->email, $user->fullName)->subject("Welcome to Motionry");
      });
    }
    else
    {
      Mail::send('emails.seeker_approved_email', [], function($message) use ($user)
      {
        $message->to($user->email, $user->fullName)->subject("Welcome to Motionry");
      });
    }
  }
});

