@extends('layouts.create_profile')

@section('form')
<div class="row" id="profile-step-2">
  <div class="col-md-10 col-md-offset-1">
    <h5>Title of technology or research (can include a tagline)</h5>
    <div class="form-group">
      {{ Form::text('tech_title',$profile->tech_title, [ 'class' => 'form-control', 'id' => 'tech_title' ]) }}
    </div>
    <h5>Description of the technology or research (max 1550 characters with spaces)</h5>
    <div class="form-group">
      <textarea id="tech_description" name="tech_description" class="form-control" maxlength="1550" rows="10">{{{ $profile->tech_description }}}</textarea>
      <div id="tech_description_charcount">
      </div>
    </div>
    <h5>Technology or research stage</h5>
    <div class="row">
      <div class="form-group">
        <div class="col-md-6">
          {{ Form::select('product_stage', array_merge(['' => 'Select stage...'], Config::get('cassini.product_stages')), $profile->product_stage, [ 'class' => 'selectpicker form-control' ] ) }} 
        </div>
      </div>
    </div>
    <h5>Intellectual property</h5>
    <div class="row">
      <div class="form-group">
        <div class="col-md-6">
          {{ Form::select('intellectual_property[]', Config::get('cassini.intellectual_property_types'), $profile->intellectualProperty, [ 'class' => 'selectpicker form-control', 'multiple' => 'multiple', 'title' => 'Select all that apply...' ] ) }} 
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
          {{ Form::select('region_ids[]', SelectHelper::get_region_options(), $profile->regionIds, [ 'class' => 'selectpicker form-control', 'multiple' => 'multiple', 'title' => 'Select all that apply...' ] ) }} 
        </div>
      </div>
    </div>
    <h5>What are the market applications?  For instance, a nanotechnology may be applicable to solar panels, HVAC, and green building materials.  Click on enter or return key after each entry to separate.</h5>
    <div class="form-group">
      <ul id="market_applications">
        @foreach ($profile->applications as $application)
          <li>{{ $application->name }}</li>
        @endforeach
      </ul>
    </div>
    <h5>Market sector</h5>
    <div class="row">
      <div class="form-group">
        <div class="col-md-6">
          {{ Form::select('sector_ids[]', SelectHelper::get_sector_options(), $profile->sectorIds, [ 'class' => 'selectpicker form-control', 'multiple' => 'multiple', 'title' => 'Select all that apply...' ] ) }} 
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
          {{ Form::select('funding_statuses[]', Config::get('cassini.funding_statuses'), $profile->fundingStatuses, [ 'class' => 'selectpicker form-control', 'multiple' => 'multiple', 'title' => 'Select all that apply...' ] ) }} 
        </div>
      </div>
    </div>
    <div class="form-group">
      <p class="help-block"><a href="#" class="add-fs-additional">Add additional info</a></p>
    </div>
    <h5 class="fs-additional" style="display:none;">If you are currently funded, provide the name of the funding organization OR if you are seeking funding, what you intend to do with the funding.  This information will appear in your published profile.</h5>
    <div class="form-group fs-additional" style="display:none;">
      <textarea id="fs_extra_info" name="fs_extra_info" class="form-control" maxlength="1550" rows="10">{{ $profile->fs_extra_info }}</textarea>
    </div>
    <div class="row">
      <hr/>
    </div>
    <h5>Upload photo of the technology or research (max 4 photos)</h5>
      <div id="photos_list">
        @foreach (range(0,3) as $idx)
          @if (sizeof($profile->photos) > $idx)
            @include('partials.photo_form', [ 'photo' => $profile->photos[$idx], 'idx' => $idx, 'label' => $idx + 1 ])
          @else
            @include('partials.photo_form', [ 'photo' => new Photo, 'idx' => $idx, 'label' => $idx + 1 ])
          @endif
        @endforeach
      </div>
      @if (false and sizeof($profile->photos) < 4)
        <div class="form-group">
          <p class="help-block col-md-offset-3"><a href="#" class="add-another-photo">Add another photo</a></p>
        </div>
      @endif


  </div>
</div>
@stop

@section ('extra_forms')
@if (false)
<div id="extra_photo" style="display:none;">
  @include('partials.photo_form', [ 'photo' => new Photo, 'idx' => '[x]', 'label' => '[0]' ])
</div>
@endif
@stop
