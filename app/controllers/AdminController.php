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

}
