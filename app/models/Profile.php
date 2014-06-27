<?php
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

class Profile extends BaseModel implements StaplerableInterface {
  use EloquentTrait;

  // there has to be another way of ignoring standard form input in one place.
  // using Input::except(['next','previous']) would lead to repeated code
  // TODO - photo
  protected $guarded = ['keypersons','next','previous','submit','edit','regions','photo','presentations','publications','awards','organization_logo','keypersons_photos','photo_photos','photos'];

  protected static $csv_headings = 'id,creator_id,status,innovator_type,institution.name,institution_department,organization,organization_type,tech_title,product_stage,fs_funded,fs_seeking,fs_not_funded,fs_extra_info,ip_trademarks,ip_trademarks_pending,ip_patents,ip_patents_pending,website_url,website_title,sectors.name,applications.name,regions.name,restrict_seekers,restrict_researchers,restrict_entrepreneurs,created_at';

  public static $rules = array();

  public function __construct(array $attributes = array())
  {
    $this->hasAttachedFile('organization_logo', array(
      'styles' => array(
        'medium' => '300',
        'small' => '100'
      ),
    ));

    parent::__construct($attributes);
  }

  public function scopePublicPublished($query)
  {
      return $query->whereStatus('PUBLISHED')
          ->whereNotNull('tech_title')
          ->where('tech_title', '!=', '')
          ->orderBy('tech_title');
  }

  public function sectors()
  {
    return $this->belongsToMany('Sector');
  }

  public function regions()
  {
    return $this->belongsToMany('Region');
  }

  public function applications()
  {
    return $this->belongsToMany('Application','profile_application');
  }

  public function publications()
  {
    return $this->hasMany('ProfilePublication');
  }

  public function keypersons()
  {
    return $this->hasMany('Keyperson');
  }

  public function presentations()
  {
    return $this->hasMany('Presentation');
  }

  public function institution()
  {
    return $this->belongsTo('Institution');
  }

  public function creator()
  {
    return $this->belongsTo('User', 'creator_id');
  }

  public function subscribers()
  {
    return $this->belongsToMany('User', 'profile_saves', 'user_id', 'profile_id')->withTimestamps();
  }

  public function collaborators()
  {
    return $this->belongsToMany('User', 'profile_permissions', 'user_id', 'profile_id')->withTimestamps();
  }

  public function photos()
  {
    return $this->hasMany('Photo');
  }

  public function awards()
  {
    return $this->hasMany('Award');
  }

  public function getSlugAttribute()
  {
    return $this->id . "-" . Str::slug($this->tech_title);
  }

  public function getPublicTaglineOrTechTitleAttribute()
  {
      return $this->public_tagline ?: $this->tech_title;
  }
  
  public function getOrganizationOrInstitutionNameAttribute()
  {
      return $this->organization ?: ($this->institution ? ($this->institution->name . ' ' . $this->institution_department) : "");
  }

  public function getPublicImageUrlAttribute()
  {
      if (!empty($this->photos) && sizeof($this->photos) > 0 && !empty($this->photos[0]->photo)) {
          return $this->photos[0]->photo->url('large');
      } elseif ($this->innovator_type == 'RESEARCHER') {
          return asset('/img/university-avatar.png');
      } else {
          return asset('/img/company-avatar.png');
      }
  }

  public function getPublicImageDescriptionAttribute()
  {
      if (!empty($this->photos) && sizeof($this->photos) > 0 && !empty($this->photos[0]->photo)) {
          return $this->photos[0]->description;
      } else {
          return $this->organization_or_institution_name;
      }
  }

  public function getPublicDescriptionAttribute()
  {
      return ($this->tech_description ? preg_replace('/\s+?(\S+)?$/', '', substr($this->tech_description, 0, 175)) : null);
  }

  public function getViewFormAttribute()
  {
    return "<a target='_blank' href='" . route('edit_profile', ['id' => $this->id ]) . "'>Use Profile Wizard</a>";
  }

  public function getWebsiteCleanUrlAttribute()
  {
    return StringHelper::clean_url($this->getAttribute('website_url'));
  }

  public function getCreatorTosAttribute()
  {
    $creator = $this->creator;
    return empty($creator) ? '' : $creator->email;
  }

  public function getStatusTosAttribute()
  {
    if (!array_key_exists($this->getAttribute('status'), Config::get('cassini.profile_statuses')))
      return Config::get('cassini.status_not_specified');
    return Config::get('cassini.profile_statuses')[$this->getAttribute('status')];
  }

  public function getKeypersonsTosAttribute()
  {
    $keypersons = [];
    foreach ($this->keypersons as $keyperson)
      $keypersons[]= $keyperson->fullName;

      //$keypersons[]= "<a href='" . URL::to('/') . "/admin/keypersons/" . $keyperson->id . "' target='_blank'>" . $keyperson->name . "</a>";
    return implode(', ', $keypersons);
  }

  public function getInnovatorTypeTosAttribute()
  {
    if (!array_key_exists($this->getAttribute('provider_type'), Config::get('cassini.provider_types')))
      return Config::get('cassini.not_specified');
    return Config::get('cassini.provider_types')[$this->getAttribute('provider_type')];
  }

  public function getRegionsTosAttribute()
  {
    $regions = [];
    foreach ($this->getAttribute('regions') as $region)
      $regions[]= $region->name;
    return implode(', ', $regions);
  } 

  public function getSectorsTosAttribute()
  {
    $sectors = [];
    foreach ($this->getAttribute('sectors') as $sector)
      $sectors[]= $sector->name;
    return implode(', ', $sectors);
  } 

  public function getPhotosCountAttribute()
  {
    $photos = $this->getAttribute('photos');
    if (empty($photos))
      return "0";
    return sizeof($photos);
  }
  public function getPresentationsCountAttribute()
  {
    $presentations = $this->getAttribute('presentations');
    if (empty($presentations))
      return "0";
    return sizeof($presentations);
  }
  public function getPublicationsCountAttribute()
  {
    $publications = $this->getAttribute('publications');
    if (empty($publications))
      return "0";
    return sizeof($publications);
  }
  // TODO - refactor these up and make generic
  public function getIntellectualPropertyAttribute()
  {
    $props = [];
    if ($this->ip_trademarks)         $props[]='TRADEMARKS';
    if ($this->ip_trademarks_pending) $props[]='TRADEMARKS_PENDING';
    if ($this->ip_patents)            $props[]='PATENTS';
    if ($this->ip_patents_pending)    $props[]='PATENTS_PENDING';
    return $props;
  }
  public function setIntellectualPropertyAttribute($value)
  {
    if (empty($value))
      $value = [];
    $this->ip_trademarks         = in_array('TRADEMARKS',         $value);
    $this->ip_trademarks_pending = in_array('TRADEMARKS_PENDING', $value);
    $this->ip_patents            = in_array('PATENTS',            $value);
    $this->ip_patents_pending    = in_array('PATENTS_PENDING',    $value);
  }
  public function getFundingStatusesAttribute()
  {
    $props = [];
    if ($this->fs_funded)     $props[]='FUNDED';
    if ($this->fs_seeking)    $props[]='SEEKING';
    if ($this->fs_not_funded) $props[]='NOT_FUNDED';
    return $props;
  }
  public function setFundingStatusesAttribute($value)
  {
    if (empty($value))
      $value = [];
    $this->fs_funded     = in_array('FUNDED',     $value);
    $this->fs_seeking    = in_array('SEEKING',    $value);
    $this->fs_not_funded = in_array('NOT_FUNDED', $value);
  }
  public function getPermissionsAttribute()
  {
    $props = [];
    if ($this->restrict_seekers)        $props[]='RESTRICT_SEEKERS';
    if ($this->restrict_researchers)    $props[]='RESTRICT_RESEARCHERS';
    if ($this->restrict_entrepreneurs)  $props[]='RESTRICT_ENTREPRENEURS';
    return $props;
  }
  public function setPermissionsAttribute($value)
  {
    if (empty($value))
      $value = [];
    $this->restrict_seekers       = in_array('RESTRICT_SEEKERS',       $value);
    $this->restrict_researchers   = in_array('RESTRICT_RESEARCHERS',   $value);
    $this->restrict_entrepreneurs = in_array('RESTRICT_ENTREPRENEURS', $value);
  }
  public function getRegionIdsAttribute()
  {
    $props = [];
    foreach ($this->regions as $region)
      $props[]= $region->id;
    return $props;
  }
  public function setRegionIdsAttribute($value)
  {
    $existing_regions = $this->regions;
    
    $existing_and_new_region_ids = [];

    // possibly remove old regions
    if (!empty($existing_regions))
    {
      foreach($existing_regions as $existing_region)
      {
        if (!in_array($existing_region->id, $value))
          $this->regions()->detach($existing_region->id);
        else
          $existing_and_new_region_ids[]= $existing_region->id;
      }
    }

    // add new regions that don't already exist
    foreach ($value as $region_id)
    {
      if (!in_array($region_id, $existing_and_new_region_ids))
        $this->regions()->attach($region_id);
    }
  }
  public function getSectorIdsAttribute()
  {
    $props = [];
    foreach ($this->sectors as $sector)
      $props[]= $sector->id;
    return $props;
  }
  public function setSectorIdsAttribute($value)
  {
    $existing_sectors = $this->sectors;
    
    $existing_and_new_sector_ids = [];

    // possibly remove old sectors
    if (!empty($existing_sectors))
    {
      foreach($existing_sectors as $existing_sector)
      {
        if (!in_array($existing_sector->id, $value))
          $this->sectors()->detach($existing_sector->id);
        else
          $existing_and_new_sector_ids[]= $existing_sector->id;
      }
    }

    // add new sectors that don't already exist
    foreach ($value as $sector_id)
    {
      if (!in_array($sector_id, $existing_and_new_sector_ids))
        $this->sectors()->attach($sector_id);
    }
  }
  public function setMarketApplicationsAttribute($value)
  {
    $existing_applications = $this->applications;

    $existing_and_new_application_names = [];

    $new_application_names = [];

    $lower_values = [];
    foreach ($value as $val) {
      $lower_values[]= strtolower($val);
    }

    // possibly detach old applications
    if (!empty($existing_applications))
    {
      foreach($existing_applications as $existing_application)
      {
        if (!in_array(strtolower($existing_application->name), $lower_values))
          $this->applications()->detach($existing_application->id);
        else
          $existing_and_new_application_names[]= strtolower($existing_application->name);
      }
    }

    // attach all of the common applications (those already in the db)
    $common_applications = Application::whereIn(DB::raw('lower(name)'),$lower_values)->get();
    foreach ($common_applications as $common_application)
    {
      // if it doesn't already exist, then attach it
      if (!in_array(strtolower($common_application->name), $existing_and_new_application_names))
      {
        $this->applications()->attach($common_application->id);
        $existing_and_new_application_names[]= strtolower($common_application->name); 
      }
    }

    // finally, add all of the applications that aren't in the database yet
    foreach ($value as $new_name)
    {
      if (!in_array(strtolower($new_name), $existing_and_new_application_names))
      { 
        $application = new Application(['name' => $new_name]);
        $application->save();
        $this->applications()->attach($application->id);
      }
    }
  }

  public function saveAssociatesForStep($input, $step)
  {
    switch ($step)
    {
      case 1:
        $this->saveAssociatesStep1($input); 
        break;
      case 2:
        $this->saveAssociatesStep2($input);
        break;
      case 3:
        $this->saveAssociatesStep3($input);
        break; 
    }

  }

  public static function fetchFullProfileForStep($profile_id, $step)
  {
    switch ($step)
    {
      case 1:
        return Profile::with('keypersons')->find($profile_id);
      case 2:
        return Profile::with(['regions','sectors','applications','photos'])->find($profile_id);
      case 3:
        return Profile::with(['presentations','publications','awards'])->find($profile_id);
    }
  }

  public static function validateForStep($input, $step)
  {
    switch ($step)
    {
      case 1:
        //$v = Keyperson::validateMultiple(Input::all());
        //return $v; 
        return null;
      case 2:
        return null;
      case 3: 
        return null;
    }
  
  }

  public function isEditor($user)
  {
    // a user is an editor if...

    // he is an admin,
    if ($user->role === 'ADMIN')
      return true;

    // he is the profile creator,
    if ($this->creator_id === $user->id)
      return true;

    // he is a collaborator
    if ($this->collaborators->contains($user->id))
      return true;

    // otherwise not an editor
    return false;
  }

  private function saveAssociatesStep1($input)
  {
    $this->associateManyRelationship($this->keypersons, 'keypersons', 'Keyperson', $this->keypersons(), $input['keypersons']);

    // organization logo
    $this->organization_logo = Input::file('organization_logo');
    $this->save();

    // keyperson logos
    $profile = Profile::find($this->id);
    foreach (Input::file('keypersons_photos') as $idx => $photo)
    {
      $profile->keypersons[$idx]->photo = $photo;
      $profile->keypersons[$idx]->save();
    }

  }

  private function saveAssociatesStep2($input)
  {
    // since empty select inputs aren't sent as POST variables, we must explicitly look for their absence
    if (!array_key_exists('intellectual_property', $input))
      $this->setIntellectualPropertyAttribute([]);
    if (!array_key_exists('region_ids', $input))
      $this->setRegionIdsAttribute([]);
    if (!array_key_exists('sector_ids', $input))
      $this->setSectorIdsAttribute([]);
    if (!array_key_exists('funding_statuses', $input))
      $this->setFundingStatusesAttribute([]);

    $this->associateManyRelationship($this->photos, 'photos', 'Photo', $this->photos(), $input['photos']);
    $this->save();

    // photos
    $profile = Profile::with('photos')->find($this->id);
    $photos = Input::file('photo_photos');
    if (!empty($photos))
    {
      foreach (Input::file('photo_photos') as $idx => $photo)
      {
        $profile->photos[$idx]->photo = $photo;
        $profile->photos[$idx]->save();
      }
    }
  }

  private function saveAssociatesStep3($input)
  {
    // since empty select inputs aren't sent as POST variables, we must explicitly look for their absence
    if (!array_key_exists('permissions', $input))
      $this->setPermissionsAttribute([]);

    $clean_presentations = [];
    foreach ($input['presentations'] as $presentation)
    {
      if ((array_key_exists('title',$presentation) and !empty($presentation['title'])) or (array_key_exists('url',$presentation) and !empty($presentation['url'])))
        $clean_presentations[]= $presentation;
    }
    $this->associateManyRelationship($this->presentations, 'presentations', 'Presentation', $this->presentations(), $clean_presentations);

    $clean_awards = [];
    foreach ($input['awards'] as $award)
    {
      if ((array_key_exists('title',$award) and !empty($award['title'])) or (array_key_exists('url',$award) and !empty($award['url'])))
        $clean_awards[]= $award;
    }

    $this->associateManyRelationship($this->awards, 'awards', 'Award', $this->awards(), $clean_awards);

    $clean_publications = [];
    foreach ($input['publications'] as $publication)
    {
      if ((array_key_exists('article_title',$publication) and !empty($publication['article_title'])) or (array_key_exists('article_url',$publication) and !empty($publication['article_url'])))
        $clean_publications[]= $publication;
    }
    $this->associateManyRelationship($this->publications, 'profile_publication', 'ProfilePublication', $this->publications(), $clean_publications);

    $this->save();
  }

  // take the existing profile->[many-type] relationship and the [many-type] input and either update existing, delete pruned, or insert and associate new [many-type] entities
  // $existing_many eg. $this->keypersons
  // $table_name    eg. 'keyperson'
  // $class         eg. 'Keyperson'
  // $relationship  eg. $this->keypersons()
  // $input_many    eg. Input::get('keypersons') 
  private function associateManyRelationship($existing_many, $table_name, $class, $relationship, $input_many)
  {
    $existing_many_ids = [];

    if (!empty($existing_many))
    {
      foreach ($existing_many as $existing)
        $existing_many_ids[]= $existing->id;
    }

    $new_many_ids = [];
    foreach ($input_many as $input_individual)
    {
      if (!empty($input_individual['id']))
      {
        // make sure use the profile id so that non-authorized users cannot delete keypersons
        $many_instance = $class::where('id',$input_individual['id'])->where('profile_id',$this->id)->first(); 
        $many_instance->fill($input_individual);
        $many_instance->save();
      }
      else
      {
        $many_instance = new $class($input_individual);
        $relationship->save($many_instance);
      }
      $new_many_ids[]= $many_instance->id;
    }

    // purge all old many's who are not part of this profile anymore
    foreach ($existing_many_ids as $existing_many_id)
    {
      if (!in_array($existing_many_id, $new_many_ids))
      {
        DB::table($table_name)->where('id',$existing_many_id)->delete();
      }
    }
  }
}
