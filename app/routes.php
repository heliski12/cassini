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
  return View::make('hello');
});


// TODO - fix this placeholder
Route::get('/admin_profile_wizard', function()
{
  return "<p style='font-size:30px;'>This is a placeholder for the profile wizard that an admin will see when they click to edit a profile through the wizard.  This option is available to use the full user interface as a normal user would see it.  This page will allow an admin to edit key people and photos inline, rather than viewing/editing them on separate pages as in the main admin tool.  When an admin is done editing this profile, they'll be redirected back to the main admin tool.  The url of this page can be configured to be anything.</p><a href='" . URL::to('/') . "/admin/profiles'>back to admin</a>";
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
    $keyperson = new Keyperson();
    //$keyperson->photo =  
  });
