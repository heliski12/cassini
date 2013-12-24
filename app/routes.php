<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
 */

Route::get('/', function()
{
  if (Auth::check())
  {
    if (Auth::user()->role !== 'PENDING')
    {
      if (empty(Auth::user()->profile))
        return Redirect::route('my_account');
      else
        return Redirect::route('marketplace');
    }
  }

	return View::make('public.landing');
});

// public
Route::post('login',  'UsersController@login');
Route::get('logout',  'UsersController@logout');
Route::post('signup', 'UsersController@signup');

// user pending approval
Route::group(array('before' => 'pre-auth'), function() 
{
  Route::get('authorization', [ 'as' => 'authorization', function()
  {
    // TODO 
    return View::make('pre-auth.landing');
    
  }]);
});

// user approved areas 
Route::group(array('before' => 'auth'), function() 
{
  Route::get('/profiles', function() 
  {
    return "Protected profiles page";
  }); 
  Route::get('/profiles/new', [ 'as' => 'new_profile', 'uses' => 'ProfilesController@newProfile' ]);
  Route::get('/profiles/{id}', [ 'as' => 'show_profile', 'uses' => 'ProfilesController@show' ]);
  Route::get('/create-profile/{step?}', [ 'as' => 'create_profile', 'uses' => 'ProfilesController@create' ])->where('step', '[1-3]');
  Route::post('/create_profile/{step?}', [ 'as' => 'store_profile', 'uses' => 'ProfilesController@store' ])->where('step', '[1-3]');
  Route::get('/edit-profile/{id}/{step?}', [ 'as' => 'edit_profile', 'uses' => 'ProfilesController@edit' ])->where('step', '[1-3]');
  //Route::post('/edit_profile/{step?}', [ 'as' => 'update_profile', 'uses' => 'ProfilesController@store' ]);
  Route::get('/marketplace', [ 'as' => 'marketplace', 'uses' => 'ProfilesController@index' ]);
  Route::get('/saved-profiles', [ 'as' => 'saved_profiles', 'uses' => 'ProfilesController@savedProfiles' ]);
  Route::get('/my-account', [ 'as' => 'my_account', 'uses' => 'UsersController@myAccount' ]);
  Route::get('/add-editor/{id}', [ 'as' => 'add_editor', 'uses' => 'ProfilesController@addEditor' ]);
  Route::post('/contact', [ 'as' => 'contact', 'uses' => 'ProfilesController@contact' ]);
  Route::post('/save-profile', [ 'as' => 'save_profile', 'uses' => 'ProfilesController@save' ]);
  Route::post('/update-password', [ 'as' => 'update_password', 'uses' => 'UsersController@updatePassword' ]);
});








// TODO - fix this placeholder
Route::get('/admin_profile_wizard', function()
{
  return "<p style='font-size:30px;'>This is a placeholder for the profile wizard that an admin will see when they click to edit a profile through the wizard.<br/><br/>  This option is available to use the full user interface as a normal user would see it.<br/><br/>This page will allow an admin to edit key people, photos, presentations, institutions inline, rather than viewing/editing them on separate pages as in the main admin tool.<br/><br/>When an admin is done editing this profile, they'll be redirected back to the main admin tool.  The url of this page can be configured to be anything.</p><a href='" . URL::to('/') . "/admin/profiles'>back to admin</a>";
});













// TODO - DEV ONLY
Event::listen('illuminate.query', function($sql,$bindings,$time) {
  for ($i = 0; $i < sizeof($bindings); $i++)
  {
    if ($bindings[$i] instanceof DateTime)
      $bindings[$i]= $bindings[$i]->getTimestamp();
  }
  Log::info(sprintf("%s (%s) : %s",$sql,implode(",",$bindings),$time));
});


// TODO - REMOVE THIS
Route::get('/info', function()
{
  phpinfo();
});

// TODO - REMOVE THIS
Route::post('/kp_test', function()
{
  //dd (Input::file('photo'));
  $keyperson = Keyperson::create(['photo' => Input::file('photo')]);
  $keyperson->save();
});

// TODO - REMOVE THIS
Route::get('/test',function()
  {
//$im = imagecreatefrompng('/tmp/blah.png');

//header('Content-Type: image/png');
//imagepng($im);
//imagedestroy($im);
    //print_r(sys_get_temp_dir());
    //$keyperson->photo =  
    //$profile = Profile::with('publications')->first();
    //dd($profile->publications);
  });
