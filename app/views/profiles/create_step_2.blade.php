@extends('layouts.create_profile')

@section('form')
<div class="row" id="profile-step-2">
  <div class="col-md-10 col-md-offset-1">
    <h5>Title of technology or research (can include a tagline)</h5>
    <div class="form-group">
      {{ Form::text('tech_title',Input::old('tech_title'), [ 'class' => 'form-control', 'id' => 'tech_title' ]) }}
    </div>
    <h5>Description of the technology or research (max 1550 characters with spaces)</h5>
    <div class="form-group">
      <textarea id="tech_description" name="tech_description" class="form-control" maxlength="1550" rows="10"></textarea>
      <div id="tech_description_charcount">
      </div>
    </div>
    <h5>Technology or research stage</h5>
    <div class="row">
      <div class="form-group">
        <div class="col-md-6">
          {{ Form::select('product_stage', array_merge(['' => 'Select stage...'], Config::get('cassini.product_stages')), null, [ 'class' => 'selectpicker form-control' ] ) }} 
        </div>
      </div>
    </div>
    <h5>Intellectual property</h5>
    <div class="row">
      <div class="form-group">
        <div class="col-md-6">
          {{ Form::select('intellectual_propery', Config::get('cassini.product_stages'), null, [ 'class' => 'selectpicker form-control', 'multiple' => 'multiple', 'title' => 'Select all that apply...' ] ) }} 
        </div>
      </div>
    </div>
    <div class="row">
      <hr/>
    </div>
    <h5>Market regions</h5>
    <div class="row">
      <div class="form-group">
        <div class="col-md-6">
          {{ Form::select('regions', SelectHelper::get_region_options(), null, [ 'class' => 'selectpicker form-control', 'multiple' => 'multiple', 'title' => 'Select all that apply...' ] ) }} 
        </div>
      </div>
    </div>
    <h5>What are the market applications?  For instance, a nanotechnology may be applicable to solar panels, HVAC, and green building materials.</h5>
    <div class="form-group">
      {{ Form::text('applications',Input::old('applications'), [ 'class' => 'form-control', 'id' => 'applications' ]) }}
    </div>
    <h5>Market sector</h5>
    <div class="row">
      <div class="form-group">
        <div class="col-md-6">
          {{ Form::select('sectors', SelectHelper::get_sector_options(), null, [ 'class' => 'selectpicker form-control', 'multiple' => 'multiple', 'title' => 'Select all that apply...' ] ) }} 
        </div>
      </div>
    </div>
    <div class="row">
      <hr/>
    </div>
    <h5>Funding status</h5>
    <div class="row">
      <div class="form-group">
        <div class="col-md-6">
          {{ Form::select('sectors', Config::get('cassini.funding_statuses'), null, [ 'class' => 'selectpicker form-control', 'multiple' => 'multiple', 'title' => 'Select all that apply...' ] ) }} 
        </div>
      </div>
    </div>
    <div class="row">
      <hr/>
    </div>
    <h5>Upload photo of the technology or research (max 4 photos)</h5>
      <div id="photos_list">
      @foreach (range(0,0) as $temp_make_this_iterate_over_photos)
            @include('partials.photo_form')
      @endforeach
      </div>
    <div class="form-group">
      <p class="help-block col-md-offset-3"><a href="#" class="add-another-photo">Add another photo</a></p>
    </div>


  </div>
</div>

<div id="extra_photo" style="display:none;">
    @include('partials.photo_form')
</div>
@stop
