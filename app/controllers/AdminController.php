<?php

class AdminController extends Controller {

  public function institutionLogo($id)
  {
    $institution = Institution::find($id);
    return View::make('admin.institution')->with('institution', $institution);
  }

  public function saveInstitutionLogo()
  {
    $institution = Institution::find(Input::get('id'));
    $institution->logo = Input::file('logo');
    $institution->save();
    return Redirect::route('institution_logo',[$institution->id]);
  }

  public function publicationPhoto($id)
  {
    $publication = Publication::find($id);
    return View::make('admin.publication')->with('publication', $publication);
  }

  public function savePublicationPhoto()
  {
    $publication = Publication::find(Input::get('id'));
    $publication->photo = Input::file('photo');
    $publication->save();
    return Redirect::route('publication_photo',[$publication->id]);
  } 

  public function csvExport()
  {
    return View::make('admin.csv');
  }

  public function csvUsers()
  {
    $csv = User::getCSVHeading();

    $users = User::all();

    foreach ($users as $user)
      $csv.= $user->getCSVLine();

    $filename = "users_". date('Ymd') .".csv";

    header("Content-Type: text/plain");
    header('Content-Disposition: attachment; filename="'.$filename.'"');
    header("Content-Length: " . strlen($csv));
    return $csv;
  }

  public function csvKeypersons()
  {
    $csv = Keyperson::getCSVHeading();

    $keypersons = Keyperson::all();

    foreach ($keypersons as $keyperson)
      $csv.= $keyperson->getCSVLine();

    $filename = "keypersons_". date('Ymd') .".csv";

    header("Content-Type: text/plain");
    header('Content-Disposition: attachment; filename="'.$filename.'"');
    header("Content-Length: " . strlen($csv));
    return $csv;
  }

  public function csvProfiles()
  {
    $csv = Profile::getCSVHeading();

    $profiles = Profile::with(['institution','sectors','applications','regions'])->get();

    foreach ($profiles as $profile)
      $csv.= $profile->getCSVLine();

    $filename = "profiles_". date('Ymd') .".csv";

    header("Content-Type: text/plain");
    header('Content-Disposition: attachment; filename="'.$filename.'"');
    header("Content-Length: " . strlen($csv));
    return $csv;
  }

}
