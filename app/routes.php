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
      $user = User::with('profiles')->find(Auth::user()->id);
      if ($user->innovator and (empty($user->profiles) or sizeof($user->profiles) == 0))
        return Redirect::route('create_profile');
      else
        return Redirect::route('marketplace');
    }
  }

	return View::make('public.landing');
});

Route::get('signup', function()
{
  return Redirect::to('/');
});

// public
Route::get('sign-in', [ 'as' => 'sign-in', 'uses' => 'UsersController@signIn' ]);
Route::post('login',  'UsersController@login');
Route::get('logout',  'UsersController@logout');
Route::post('signup', 'UsersController@signup');
Route::controller('reminders', 'RemindersController');
Route::post('/pcontact', [ 'as' => 'pcontact', 'uses' => 'UsersController@pcontact' ]);

// innovator public pages
Route::get('innovators/{slug}', [ 'as' => 'show_public_profile', 'uses' => 'ProfilesController@showPublic' ]);

// sitemap
Route::get('sitemap', [ 'as' => 'sitemap', 'uses' => 'SitemapController@sitemap' ]);

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
  Route::get('/profiles/new', [ 'as' => 'new_profile', 'uses' => 'ProfilesController@newProfile' ]);
  Route::get('/profiles/{id}', [ 'as' => 'show_profile', 'uses' => 'ProfilesController@show' ]);
  Route::get('/create-profile/{step?}', [ 'as' => 'create_profile', 'uses' => 'ProfilesController@create' ])->where('step', '[1-3]');
  Route::post('/create_profile/{step?}', [ 'as' => 'store_profile', 'uses' => 'ProfilesController@store' ])->where('step', '[1-3]');
  Route::get('/edit-profile/{id}/{step?}', [ 'as' => 'edit_profile', 'uses' => 'ProfilesController@edit' ])->where('step', '[1-3]');
  //Route::post('/edit_profile/{step?}', [ 'as' => 'update_profile', 'uses' => 'ProfilesController@store' ]);
  Route::get('/innovators', [ 'as' => 'marketplace', 'uses' => 'ProfilesController@index' ]);
  Route::get('/saved-profiles', [ 'as' => 'saved_profiles', 'uses' => 'UsersController@savedProfiles' ]);
  Route::get('/my-account', [ 'as' => 'my_account', 'uses' => 'UsersController@myAccount' ]);
  Route::post('/add-editor', [ 'as' => 'add_editor', 'uses' => 'ProfilesController@addEditor' ]);
  Route::post('/remove-editor', [ 'as' => 'remove_editor', 'uses' => 'ProfilesController@removeEditor' ]);
  Route::post('/remove-saved-profile', [ 'as' => 'remove_saved_profile', 'uses' => 'UsersController@removeSavedProfile' ]);
  Route::post('/contact', [ 'as' => 'contact', 'uses' => 'ProfilesController@contact' ]);
  Route::post('/contact-multiple', [ 'as' => 'contact_multiple', 'uses' => 'ProfilesController@contactMultiple' ]);
  Route::post('/email', [ 'as' => 'email', 'uses' => 'UsersController@email' ]);
  Route::post('/save-profile', [ 'as' => 'save_profile', 'uses' => 'ProfilesController@save' ]);
  Route::post('/update-password', [ 'as' => 'update_password', 'uses' => 'UsersController@updatePassword' ]);
});

// admin only
Route::group(array('before' => 'admin'), function()
{
  Route::get('admin_institution_logo/{id}', ['as' => 'institution_logo', 'uses' => 'AdminController@institutionLogo' ]);
  Route::post('admin_institution_logo', ['as' => 'save_institution_logo', 'uses' => 'AdminController@saveInstitutionLogo' ]);
  Route::get('admin_publication_photo/{id}', ['as' => 'publication_photo', 'uses' => 'AdminController@publicationPhoto' ]);
  Route::post('admin_publication_photo', ['as' => 'save_publication_photo', 'uses' => 'AdminController@savePublicationPhoto' ]);
  Route::get('csv', [ 'as' => 'csv_export', 'uses' => 'AdminController@csvExport' ]);
  Route::get('admin_csv_users', [ 'as' => 'csv_users', 'uses' => 'AdminController@csvUsers' ]);
  Route::get('admin_csv_keypersons', [ 'as' => 'csv_keypersons', 'uses' => 'AdminController@csvKeypersons' ]);
  Route::get('admin_csv_profiles', [ 'as' => 'csv_profiles', 'uses' => 'AdminController@csvProfiles' ]);
  Route::get('admin_all_public_profiles', [ 'as' => 'admin_all_public_profiles', 'uses' => 'AdminController@publicProfiles' ]);
});

if (app()->env !== 'production')
{
  Event::listen('illuminate.query', function($sql,$bindings,$time) {
    for ($i = 0; $i < sizeof($bindings); $i++)
    {
      if ($bindings[$i] instanceof DateTime)
        $bindings[$i]= $bindings[$i]->getTimestamp();
    }
    Log::info(sprintf("%s (%s) : %s",$sql,implode(",",$bindings),$time));
  });

  Route::get('/test', function() {


      $profiles = Profile::whereNotNull('tech_title')->where('tech_title', '!=', '')->get();

      $fp = fopen(base_path() . '/output/public_provile_urls.csv', 'w');
      
      foreach ($profiles as $profile) {
          $slug = $profile->slug;
          $arr = [$profile->tech_title, 'http://www.motionry.com/innovators/' . $slug];
          fputcsv($fp, $arr); 
      }

      fclose($fp);
  });
}

