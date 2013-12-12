@extends('layouts.create_profile')

@section('form')
<div class="row">
  <div class="col-md-10 col-md-offset-1">
    <h5>What type of Innovator are you?</h5>
    <div class="radio col-md-9 col-md-offset-3">
      <label class="radio-label">
        <input type="radio" name="innovator_type" value="researcher">
        Researcher
      </label>
    </div>
    <div class="col-md-9 col-md-offset-3 innovator-type-extras collapse" id="researcher">
      <div class="form-group">
        {{ Form::label('institution_id', 'Academic or Government&nbsp;Institution', [ 'class' => 'control-label' ]) }}
        {{ Form::select('institution_id', ['' => 'Select an Institution...', '1' => 'Stanford University', '2' => 'More will be populated thru Admin'], null, [ 'class' => 'form-control' ] ) }} 
      </div>
      <div class="form-group">
        {{ Form::label('institution_department', 'Department', [ 'class' => 'control-label' ]) }}
        {{ Form::text('institution_department',Input::old('institution_department'), [ 'class' => 'form-control', 'id' => 'institution_department' ]) }}
      </div>
    </div>
    <div class="radio col-md-9 col-md-offset-3">
      <label class="radio-label">
        <input type="radio" name="innovator_type" value="entrepreneur">
        Entrepreneur
      </label>
    </div>
    <div class="col-md-9 col-md-offset-3 innovator-type-extras collapse" id="entrepreneur">
      <div class="form-group">
        {{ Form::label('organization', 'Organization', [ 'class' => 'control-label' ]) }}
        {{ Form::text('organization',Input::old('organization'), [ 'class' => 'form-control', 'id' => 'organization' ]) }}
      </div>
      <div class="form-group form-group-label">
        <label>Select what type of organization:</label>
      </div>
      <div class="radio">
        <label class="sub-radio-label">
          <input type="radio" name="organization_type" value="for_profit">
          For Profit
        </label>
      </div>
      <div class="radio">
        <label class="sub-radio-label">
          <input type="radio" name="organization_type" value="non_profit">
          Non Profit
        </label>
      </div>
      <div class="form-group">
        {{ Form::label('entrepreneur_logo', 'Upload&nbsp;logo (5&nbsp;MB&nbsp;max)', [ 'class' => 'control-label' ]) }}
        {{ Form::file('entrepreneur_logo',[ 'class' => 'form-control', 'id' => 'entrepreneur_logo' ]) }}
      </div>
    </div>
    <div class="row">
      <hr/>
    </div>


    <div class="panel-group" id="kp_accordion">
      @foreach (range(0,0) as $temp_make_this_iterate_over_keypersons)
      <div class="panel panel-default">
        <div class="panel-heading">
          <h5><a data-toggle="collapse" data-parent"#kp_accordion" href="#collapse_kp0" class="icon">Key Researcher or Entrepreneur&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-up"></span></a></h5>
        </div>
        <div id="collapse_kp0" class="panel-collapse collapse in">
          <div class="panel-body">
            @include('partials.keyperson_form')
          </div>
        </div>
      </div>
      @endforeach
    </div>

    <div class="form-group">
      <p class="help-block col-md-offset-3"><a href="#" class="add-another-kp">Add another team member</a></p>
    </div>

  </div>
</div>

<div id="extra_keyperson" style="display:none;">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h5><a data-toggle="collapse" data-parent"#kp_accordion" href="#collapse_kp{x}" class="icon">Team Member {x}&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-up"></span></a></h5>
    </div>
    <div id="collapse_kp{x}" class="panel-collapse collapse in">
      <div class="panel-body">
        @include('partials.keyperson_form')
      </div>
    </div>
  </div>
</div>
@stop
