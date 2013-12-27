<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class MigratePostgres extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'migrate:postgres';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Migrate the Postgres database';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return void
	 */
	public function fire()
	{
    $academics = DB::connection('pgsql')->select("SELECT * FROM academics");
    $profiles = DB::connection('pgsql')->select("SELECT * FROM profiles");
    $savedprofiles = DB::connection('pgsql')->select("SELECT * FROM savedprofiles");
    $users = DB::connection('pgsql')->select("SELECT * FROM users");	
    $webpublications = DB::connection('pgsql')->select("SELECT * FROM webpublications");
    
    foreach ($academics as $academic)
    {
      $institution = new Institution;
      $institution->id = $academic->id;
      $institution->type = 'ACADEMIC';
      $institution->status = $academic->publish === false ? 'NOT_PUBLISHED' : 'PUBLISHED';
      $institution->creator_id = 13;
      $institution->name = $academic->name;
      $institution->email = $academic->email;
      $institution->phone = $academic->phone;
      $institution->city = $academic->city;
      $institution->state = $academic->state;
      $institution->country = $academic->country;
      //////////////////////////////////// TODO - LOGO /////////////////////////////////////////
      $institution->save();
    }

    foreach ($webpublications as $webpublication)
    {
      $publication = new Publication;
      $publication->id = $webpublication->id;
      $publication->name = $webpublication->name;
      ////////////////////////////////// TODO - PHOTO //////////////////////////////////////////
      $publication->save();
    }

    foreach ($users as $user)
    {
      $new_user = new User;
      $new_user->id = $user->id;
      $new_user->first_name = $user->firstname;
      $new_user->last_name = $user->lastname;
      $new_user->email = strtolower($user->email);
      //$new_user->migrate_password = $user->password_digest; 
      $new_user->password = 'abc123';  ///////////////////// TODO /////////////////////
      $new_user->innovator = $user->innovator; 
      $new_user->seeker = $user->seeker;
      $new_user->unsure = $user->unsure; 
      $new_user->title = $user->title; 
      $new_user->organization = $user->organization; 
      $new_user->role = ($user->authorized === true ? ($user->madmin === true ? 'ADMIN' : 'USER') : 'PENDING');
      $new_user->phone = $user->phone; 
      $new_user->created_at = explode(".",$user->created_at)[0]; 
      $new_user->updated_at = explode(".",$user->updated_at)[0];

      // carry over from old database - i was not an admin
      if ($new_user->id === 45)
        $new_user->role = 'ADMIN';

      $new_user->save();
    }

    foreach ($profiles as $profile)
    {
      $new_profile = new Profile;
      $new_profile->id = $profile->id;
      $new_profile->creator_id = $profile->user_id;
      $new_profile->status = $profile->publish === true ? 'PUBLISHED' : 'COMPLETE_PENDING';
      $new_profile->innovator_type = $profile->providertype === 1 ? 'ENTREPRENEUR' : 'RESEARCHER';
      $new_profile->institution_id = $profile->academic_id;
      $new_profile->institution_department = $profile->department;
      $new_profile->organization = $profile->organization;
      $new_profile->organization_type = $profile->forProfit === true ? 'FOR_PROFIT' : ($profile->forProfit === false ? 'NON_PROFIT' : null);
      $new_profile->tech_title = $profile->tagline;
      $new_profile->tech_description = $profile->summary;
      $new_profile->product_stage = $this->stages[$profile->stage];
      $new_profile->fs_funded = $profile->funded === true;
      $new_profile->fs_not_funded = empty($profile->funded);
      $new_profile->fs_seeking = $profile->funded === false;
      $new_profile->fs_extra_info = !empty($profile->fundinginfo) ? $profile->fundinginfo : $profile->fundingsought;
      $new_profile->ip_trademarks = $profile->trademarks;
      $new_profile->ip_trademarks_pending = $profile->trademarkspending;
      $new_profile->ip_patents = $profile->patents;
      $new_profile->ip_patents_pending = $profile->patentspending;
      $new_profile->website_url = $profile->webpage;
      $new_profile->created_at = explode(".",$profile->created_at)[0]; 
      $new_profile->updated_at = explode(".",$profile->updated_at)[0];
      $new_profile->save();

      $keyperson = new Keyperson;
      $keyperson->profile_id = $new_profile->id;
      $keyperson->first_name = explode(" ",$profile->keyperson1)[0];
      $keyperson->last_name = implode(" ", array_slice(explode(" ",$profile->keyperson1),1));
      $keyperson->title = $profile->keyperson1title;
      $keyperson->email = $profile->email;
      $keyperson->phone = $profile->phone;
      $keyperson->twitter_handle = $profile->twitter;
      $keyperson->linkedin_url = $profile->linkedin;
      $keyperson->address = $profile->address1;
      $keyperson->address_line2 = $profile->address2;
      $keyperson->address_line3 = $profile->address3;
      $keyperson->city = $profile->city;
      $keyperson->state = $profile->state;
      $keyperson->zip_code = $profile->zip;
      $keyperson->country = $profile->country;
      /////////////////////////// TODO - PHOTO ///////////////////////////////////
      $keyperson->save();

      // keypersons
      foreach (range(2,15) as $idx)
      {
        $kp = 'keyperson'.$idx;
        $kp_title = 'keyperson'.$idx.'title';
        //////////////////////////////// TODO - PHOTO ////////////////////////////

        if (!empty($profile->$kp))
        {
          $keyperson = new Keyperson;
          $keyperson->profile_id = $new_profile->id;
          $keyperson->first_name = explode(" ",$profile->$kp)[0];
          $keyperson->last_name = implode(" ", array_slice(explode(" ",$profile->$kp),1));
          $keyperson->title = $profile->$kp_title;
          //////////////////////// TODO - PHOTO ///////////////////////////
          $keyperson->save();
        }
      }

      // applications
      $applications = explode("; ",$profile->applications);
      foreach ($applications as $application)
      {
        $application = trim($application);
        $application = ucwords($application);
        $existing_application = Application::where('name',$application)->first();
        if (!empty($existing_application))
          $new_profile->applications()->attach($existing_application->id);
        else
        {
          $new_application = new Application;
          $new_application->name = $application;
          $new_application->save();
          $new_profile->applications()->attach($new_application->id);
        }
      }

      // presentations
      foreach (range(1,10) as $idx)
      {
        $pres_title = 'presentation'.$idx.'title';
        $pres_url = 'presentation'.$idx.'url';
        if (!empty($profile->$pres_title) or !empty($profile->$pres_url))
        {
          $presentation = new Presentation;
          $presentation->profile_id = $new_profile->id;
          $presentation->title = $profile->$pres_title;
          $presentation->url = $profile->$pres_url;
          $presentation->save();
        }
      }

      // publications
      foreach (range(1,10) as $idx)
      {
        $pub_title = 'publication'.$idx.'title';
        $pub_url = 'publication'.$idx.'url';
        $pub_id = 'publication'.$idx.'pubA';
        $pub_name = 'publication'.$idx.'pubB';

        if (!empty($profile->$pub_title))
        {
          $publication = new ProfilePublication;
          $publication->profile_id = $new_profile->id;
          $publication->publication_id = $profile->$pub_id; 
          $publication->article_title = $profile->$pub_title;
          $publication->article_url = $profile->$pub_url;
          $publication->name = $profile->$pub_name;
          $publication->save();
        }
      }

      // awards

      // regions
      foreach (range(1,9) as $idx)
      {
        $region = "region".$idx; 
        if ($profile->$region)
          $new_profile->regions()->attach($idx);
      }

      // sectors
      foreach (range(1,7) as $idx)
      {
        $sector = "sector".$idx;
        if ($profile->$sector)
          $new_profile->sectors()->attach($idx);
      }

      // photos 
      ///////////////////////////// TODO ////////////////////////////////
      // photo, imagetext




    }

    foreach ($savedprofiles as $savedprofile)
    {
    }

	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			//array('example', InputArgument::REQUIRED, 'An example argument.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			//array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

  private $stages = [ '1' => 'EXPERIMENTAL', '2' => 'PROTOTYPE', '3' => 'MARKET_PILOT', '4' => 'MARKET' ];

}
