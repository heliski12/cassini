@extends('layouts.create_profile')

@section('form')
<div class="row" id="profile-step-3">
  <div class="col-md-10 col-md-offset-1">
    <h5>Webpage URL</h5>
    <div class="form-horizontal">
      <div class="form-group">
        {{ Form::label('website_title', 'Title', [ 'class' => 'col-md-1 control-label' ]) }}
        <div class="col-md-11">
          {{ Form::text('website_title',Input::old('website_title'), [ 'class' => 'form-control' ]) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('website_url', 'URL', [ 'class' => 'col-md-1 control-label' ]) }}
        <div class="col-md-11">
          {{ Form::text('website_url',Input::old('website_url'), [ 'class' => 'form-control' ]) }}
        </div>
      </div>
    </div>
    <div class="row">
      <hr/>
    </div>
    <h5>Presentations</h5>
    <div id="presentations_list">
    @foreach (range(0,0) as $temp_make_this_iterate_over_presentations)
      @include('partials.presentation_form')
    @endforeach
    </div>
    <div class="form-group">
      <p class="help-block col-md-offset-1"><a href="#" class="add-another-presentation">Add another presentation</a></p>
    </div>
    <div class="row">
      <hr/>
    </div>
    <h5>Publications</h5>
    <div id="publications_list">
    @foreach (range(0,0) as $temp_make_this_iterate_over_publications)
      @include('partials.publication_form')
    @endforeach
    </div>
    <div class="form-group">
      <p class="help-block col-md-offset-1"><a href="#" class="add-another-publication">Add another publication</a></p>
    </div>
    <div class="row">
      <hr/>
    </div>
    <h5>Awards</h5>
    <div id="awards_list">
    @foreach (range(0,0) as $temp_make_this_iterate_over_awards)
      @include('partials.award_form')
    @endforeach
    </div>
    <div class="form-group">
      <p class="help-block col-md-offset-1"><a href="#" class="add-another-award">Add another award</a></p>
    </div>
    <div class="row">
      <hr/>
    </div>
    <h5>Videos</h5>
    <div class="form-horizontal">
      <div class="form-group">
        <div class="col-md-3 col-md-offset-1">
          {{ Form::button('Choose file', [ 'class' => 'btn', 'id' => 'upload_video' ]) }}
        </div>
      </div>
    </div>
    <div class="row">
      <hr/>
    </div>
    <h5>Your profile is viewable by everyone.  If you want to restrict, select the type of viewer you do NOT want to view your profile.</h5>
    <div class="form-horizontal">
      <div class="form-group">
        <div class="col-md-6 col-md-offset-1">
          {{ Form::select('permissions', Config::get('cassini.viewer_types'), null, [ 'class' => 'selectpicker form-control', 'multiple' => 'multiple', 'title' => 'Select all that apply...' ] ) }} 
        </div>
      </div>
    </div>
    <div class="row">
      <hr/>
    </div>
    <div class="form-horizontal">
      <div class="form-group terms">
        <div class="checkbox col-md-11">
          <label>
            <input type="checkbox" > I accept the <a href="{{ URL::to('/') }}" target="_blank">Terms of Service and Privacy Policy</a>
          </label>
        </div> 
      </div>
    </div>


  </div>
</div>

<div id="extra_presentation" style="display:none;">
    @include('partials.presentation_form')
</div>
<div id="extra_publication" style="display:none;">
    @include('partials.publication_form')
</div>
<div id="extra_award" style="display:none;">
    @include('partials.award_form')
</div>
@stop
