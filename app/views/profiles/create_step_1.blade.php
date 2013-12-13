@extends('layouts.create_profile')

@section('form')
<div class="row">
  <div class="col-md-10 col-md-offset-1">
    <h5>What type of Innovator are you?</h5>
    <div class="radio col-md-9 col-md-offset-3">
      <label class="radio-label">
        <input type="radio" name="innovator_type" value="RESEARCHER" {{ ($profile->innovator_type === 'RESEARCHER') ? 'checked' : '' }} >
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
        {{ Form::text('institution_department',$profile->institution_department, [ 'class' => 'form-control', 'id' => 'institution_department' ]) }}
      </div>
    </div>
    <div class="radio col-md-9 col-md-offset-3">
      <label class="radio-label">
        <input type="radio" name="innovator_type" value="ENTREPRENEUR" {{ ($profile->innovator_type === 'ENTREPRENEUR') ? 'checked' : '' }}>
        Entrepreneur
      </label>
    </div>
    <div class="col-md-9 col-md-offset-3 innovator-type-extras collapse" id="entrepreneur">
      <div class="form-group">
        {{ Form::label('organization', 'Organization', [ 'class' => 'control-label' ]) }}
        {{ Form::text('organization',$profile->organization, [ 'class' => 'form-control', 'id' => 'organization' ]) }}
      </div>
      <div class="form-group form-group-label">
        <label>Select what type of organization:</label>
      </div>
      <div class="radio">
        <label class="sub-radio-label">
          <input type="radio" name="organization_type" value="FOR_PROFIT">
          For Profit
        </label>
      </div>
      <div class="radio">
        <label class="sub-radio-label">
          <input type="radio" name="organization_type" value="NON_PROFIT">
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
      @if (Input::old('keypersons'))
        @foreach (Input::old('keypersons') as $idx => $keyperson)
          <div class="panel panel-default">
            <div class="panel-heading">
              @if ($idx == 0)
              <h5><a data-toggle="collapse" data-parent"#kp_accordion" href="#collapse_kp0" class="icon">Key Researcher or Entrepreneur&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-up"></span></a></h5>
              @else
              <h5><a data-toggle="collapse" data-parent"#kp_accordion" href="#collapse_kp{{$idx}}" class="icon">Team Member {{$idx}}&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-up"></span></a></h5>
              @endif
            </div>
            <div id="collapse_kp{{$idx}}" class="panel-collapse collapse in">
              <div class="panel-body">
                @include('partials.keyperson_form', [ 'idx' => $idx, 'keyperson' => new Keyperson($keyperson) ])
              </div>
            </div>
          </div>
        @endforeach
      @elseif (empty($profile->keypersons))
        <div class="panel panel-default">
          <div class="panel-heading">
            <h5><a data-toggle="collapse" data-parent"#kp_accordion" href="#collapse_kp0" class="icon">Key Researcher or Entrepreneur&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-up"></span></a></h5>
          </div>
          <div id="collapse_kp0" class="panel-collapse collapse in">
            <div class="panel-body">
              @include('partials.keyperson_form', [ 'idx' => 0, 'keyperson' => new Keyperson ])
            </div>
          </div>
        </div>
      @else
        @foreach ($profile->keypersons as $idx => $keyperson)
          <div class="panel panel-default">
            <div class="panel-heading">
              @if ($idx == 0)
              <h5><a data-toggle="collapse" data-parent"#kp_accordion" href="#collapse_kp0" class="icon">Key Researcher or Entrepreneur&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-up"></span></a></h5>
              @else
              <h5><a data-toggle="collapse" data-parent"#kp_accordion" href="#collapse_kp{{$idx}}" class="icon">Team Member {{$idx}}&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-up"></span></a></h5>
              @endif
            </div>
            <div id="collapse_kp{{$idx}}" class="panel-collapse collapse in">
              <div class="panel-body">
                @include('partials.keyperson_form', [ 'idx' => $idx, 'keyperson' => $keyperson ])
              </div>
            </div>
          </div>
        @endforeach
      @endif
    </div>

    <div class="form-group">
      <p class="help-block col-md-offset-3"><a href="#" class="add-another-kp">Add another team member</a></p>
    </div>

  </div>
</div>

@stop

@section ('extra_forms')
  <div id="extra_keyperson" style="display:none;">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h5><a data-toggle="collapse" data-parent"#kp_accordion" href="#collapse_kp[x]" class="icon">Team Member [x]&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-chevron-up"></span></a></h5>
      </div>
      <div id="collapse_kp[x]" class="panel-collapse collapse in">
        <div class="panel-body">
          @include('partials.keyperson_form', [ 'idx' => 0, 'keyperson' => new Keyperson ])
        </div>
      </div>
    </div>
  </div>
@endsection
