@extends('layouts.create_profile')

@section('form')

                <div class="panel-group" id="kp_accordion">


                  <div class="panel">

          <div id="collapse_kp0" class="panel-collapse collapse in">
            <div class="panel-body">
              <div class="bottom-buffer">
                <h5 class="top-buffer">What type of Innovator are you?</h5>
                <em class="public-warning">If you elect to have your profile visible for everyone on Motionry, the information noted with an orange asterisk will be shown on an internet search.</em>
                <div class="radio">
                  <label class="radio-label">
                    <input type="radio" name="innovator_type" value="RESEARCHER" {{ ($profile->innovator_type === 'RESEARCHER') ? 'checked' : '' }} >
                    Researcher
                  </label>
                </div>
                <div class="row">
                <div class="col-md-7 col-md-offset-3 innovator-type-extras collapse" id="researcher">
                  <div class="form-group col-md-12">
                    {{ Form::label('institution_id', 'Academic or Government&nbsp;Institution', [ 'class' => 'control-label' ]) }}
                    <span class="asterisk">&nbsp;&nbsp;&nbsp;*</span>
                    {{ Form::select('institution_id', SelectHelper::get_institution_options(), $profile->institution_id, [ 'class' => 'form-control' ] ) }} 
                  </div>
                  <div class="form-group col-md-12">
                    {{ Form::label('institution_department', 'Department', [ 'class' => 'control-label' ]) }}
                    <span class="asterisk">&nbsp;&nbsp;&nbsp;*</span>
                    {{ Form::text('institution_department',$profile->institution_department, [ 'class' => 'form-control', 'id' => 'institution_department' ]) }}
                  </div>
                  </div>
                </div>
                  <div class="radio">
                    <label class="radio-label">
                      <input type="radio" name="innovator_type" value="ENTREPRENEUR" {{ ($profile->innovator_type === 'ENTREPRENEUR') ? 'checked' : '' }}>
                      Entrepreneur
                    </label>
                  </div>
                 <div class="row"> 
                  <div class="col-md-7 col-md-offset-3 innovator-type-extras collapse" id="entrepreneur">
                    <div class="form-group col-md-12">
                      {{ Form::label('organization', 'Organization', [ 'class' => 'control-label' ]) }}
                      <span class="asterisk">&nbsp;&nbsp;&nbsp;*</span>
                      {{ Form::text('organization',$profile->organization, [ 'class' => 'form-control', 'id' => 'organization' ]) }}
                    </div>
                      <div class="form-group col-md-12 form-group-label">
                        <label>Select what type of organization:</label>
                      </div>
                      <div class="radio">
                        <label class="sub-radio-label">
                          <input type="radio" name="organization_type" value="FOR_PROFIT" {{ ($profile->organization_type === 'FOR_PROFIT') ? 'checked' : '' }} >
                          For Profit
                        </label>
                      </div>
                      <div class="radio">
                        <label class="sub-radio-label">
                          <input type="radio" name="organization_type" value="NON_PROFIT" {{ ($profile->organization_type === 'NON_PROFIT') ? 'checked' : '' }} >
                          Non Profit
                        </label>
                      </div>
                      <div class="form-group col-md-12" id="organization_logo_fg">
                        @if (!empty($profile->organization_logo_file_name))
                          <div>
                            <label class="control-label">Logo</label>
                          </div>
                          <img class="organization-logo" src="{{ asset($profile->organization_logo->url('small')) }}" />
                        @endif
                          <div>
                          {{ Form::label('organization_logo', 'Upload&nbsp;logo (5&nbsp;MB&nbsp;max)', [ 'class' => 'control-label' ]) }}
                          {{ Form::file('organization_logo',[ 'class' => 'form-control form-bottom', 'id' => 'organization_logo' ]) }}
                          </div>
                      </div>
                    </div> <!-- innovator-type-extras -->
                  </div> <!-- row -->
                </div> <!-- bottom-buffer -->

                @if (Input::old('keypersons'))
                    @foreach (Input::old('keypersons') as $idx => $keyperson)
                        <div class="kp{{$idx}}">
                          @if ($idx == 0)
                          @else
                          <h5 class="team-member"><a data-toggle="collapse" data-parent"#kp_accordion" href="#collapse_kp{{$idx}}" class="icon">Team Member {{$idx}}&nbsp;&nbsp;&nbsp;<span title="Collapse view" class="glyphicon glyphicon-chevron-up"></span></a>&nbsp;
                              <a href="#" class="icon remove-tm" id="remove_tm_{{$idx}}" title="Remove team member"><span class="glyphicon glyphicon-remove"></span></a> 
                          </h5>
                          @endif
                        </div>
                        <div id="collapse_kp{{$idx}}" class="kp{{$idx}} panel-collapse collapse in">
                            @include('partials.keyperson_form', [ 'idx' => $idx, 'keyperson' => new Keyperson($keyperson) ])
                        </div>
                    @endforeach
                @elseif (empty($profile->keypersons) || sizeof($profile->keypersons) == 0)
                        @include('partials.keyperson_form', [ 'idx' => 0, 'keyperson' => new Keyperson ])
                @else
                    @foreach ($profile->keypersons as $idx => $keyperson)
                        <div class="kp{{$idx}}">
                          @if ($idx == 0)
                          @else
                          <h5 class="team-member"><a data-toggle="collapse" data-parent"#kp_accordion" href="#collapse_kp{{$idx}}" class="icon">Team Member {{$idx}}&nbsp;&nbsp;&nbsp;<span title="Collapse view" class="glyphicon glyphicon-chevron-up"></span></a>&nbsp;
                            <a href="#" class="icon remove-tm" id="remove_tm_{{$idx}}" title="Remove team member"><span class="glyphicon glyphicon-remove"></span></a> 
                          </h5>
                          @endif
                        </div>
                        <div id="collapse_kp{{$idx}}" class="kp{{$idx}} panel-collapse collapse in">
                            @include('partials.keyperson_form', [ 'idx' => $idx, 'keyperson' => $keyperson ])
                        </div>
                    @endforeach
                @endif
            </div>
          </div>
        </div>
      </div> <!-- kp accordion -->

      <div class="form-group">
        <p class="help-block col-md-offset-3 top-buffer"><a href="#" class="add-another-kp">Add another team member</a></p>
      </div>
@stop

@section ('extra_forms')
  <div id="extra_keyperson" style="display:none;">
    <div class="panel panel-default">
      <div class="panel-heading kp[x]">
        <h5 class="team-member"><a data-toggle="collapse" data-parent"#kp_accordion" href="#collapse_kp[x]" class="icon">Team Member [x]&nbsp;&nbsp;&nbsp;<span title="Collapse view" class="glyphicon glyphicon-chevron-up"></span></a>&nbsp;
          <a href="#" title="Remove team member" id="remove_tm_[x]" class="icon remove-tm"><span class="glyphicon glyphicon-remove"></span></a> 
        </h5>
      </div>
      <div id="collapse_kp[x]" class="kp[x] panel-collapse collapse in">
          @include('partials.keyperson_form', [ 'idx' => '[x]', 'keyperson' => new Keyperson ])
      </div>
    </div>
  </div>
@endsection
