@extends('layouts.create_profile')

@section('form')
<div class="row" id="profile-step-3">
  <div class="col-md-10 col-md-offset-1">
    <h5>Webpage URL</h5>
    <div class="form-horizontal">
      <div class="form-group">
        {{ Form::label('website_title', 'Title', [ 'class' => 'col-md-2 control-label' ]) }}
        <div class="col-md-10">
          {{ Form::text('website_title',$profile->website_title, [ 'class' => 'form-control' ]) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('website_url', 'URL', [ 'class' => 'col-md-2 control-label' ]) }}
        <div class="col-md-10">
          {{ Form::text('website_url',$profile->website_url, [ 'class' => 'form-control' ]) }}
        </div>
      </div>
    </div>
    <div class="row">
      <hr/>
    </div>
    <h5>Presentations</h5>
    <div id="presentations_list">
      @if (empty($profile->presentations) or sizeof($profile->presentations) == 0)
        @include('partials.presentation_form', [ 'idx' => 0, 'presentation' => new Presentation, 'show_remove' => false ])
      @else
        @foreach ($profile->presentations as $idx => $presentation)
          @include('partials.presentation_form', [ 'idx' => $idx, 'presentation' => $presentation, 'show_remove' => ($idx > 0) ])
        @endforeach
      @endif
    </div>
    <div class="form-group">
      <p class="help-block col-md-offset-1"><a href="#" class="add-another-presentation">Add another presentation</a></p>
    </div>
    <div class="row">
      <hr/>
    </div>
    <h5>Publications</h5>
    <div id="publications_list">
      @if (empty($profile->publications) or sizeof($profile->publications) == 0)
        @include('partials.publication_form', [ 'idx' => 0, 'publication' => new ProfilePublication, 'show_remove' => false ])
      @else
        @foreach ($profile->publications as $idx => $publication)
          @include('partials.publication_form', [ 'idx' => $idx, 'publication' => $publication, 'show_remove' => ($idx > 0) ])
        @endforeach
      @endif
    </div>
    <div class="form-group">
      <p class="help-block col-md-offset-1"><a href="#" class="add-another-publication">Add another publication</a></p>
    </div>
    <div class="row">
      <hr/>
    </div>
    <h5>Awards</h5>
    <div id="awards_list">
      @if (empty($profile->awards) or sizeof($profile->awards) == 0)
        @include('partials.award_form', [ 'idx' => 0, 'award' => new Award, 'show_remove' => false ])
      @else
        @foreach ($profile->awards as $idx => $award)
          @include('partials.award_form', [ 'idx' => $idx, 'award' => $award, 'show_remove' => ($idx > 0) ])
        @endforeach
      @endif
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
        <div class="col-md-3 col-md-offset-2">
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
        <div class="col-md-7 col-md-offset-2">
          {{ Form::select('permissions[]', Config::get('cassini.viewer_types'), $profile->permissions , [ 'class' => 'selectpicker form-control', 'multiple' => 'multiple', 'title' => 'Select all that apply...' ] ) }} 
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

@stop

@section('extra_forms')
<div id="extra_presentation" style="display:none;">
  @include('partials.presentation_form', [ 'idx' => '[x]', 'presentation' => new Presentation, 'show_remove' => 'true' ])
</div>
<div id="extra_publication" style="display:none;">
  @include('partials.publication_form', [ 'idx' => '[x]', 'publication' => new ProfilePublication, 'show_remove' => 'true', 'extra' => true ] )
</div>
<div id="extra_award" style="display:none;">
  @include('partials.award_form', [ 'idx' => '[x]', 'award' => new Award, 'show_remove' => 'true' ])
</div>
@stop
