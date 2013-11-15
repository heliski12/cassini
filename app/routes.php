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

// TODO - REMOVE THIS
Route::get('/info', function()
{
  phpinfo();
});

Route::post('/kp_test', function()
{
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
    print_r(sys_get_temp_dir());
  });
