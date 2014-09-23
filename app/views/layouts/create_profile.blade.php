@extends('layouts.master')

@section('content')

    <div class="create-profile">

            <h1 class="welcome">Welcome to the private beta. You are just minutes away from establishing your profile.</h1>

          <div id="steps-wrap">
            <div class="steps-nav">
              <ul class="steps">
                <li class="{{ $step == 1 ? 'active' : '' }}">1</li>
                <li class="{{ $step == 2 ? 'active' : '' }}">2</li>
                <li class="{{ $step == 3 ? 'active' : '' }}">3</li>
              </ul>
            </div>



            <div class="steps-nav">
              <ul class="step-titles">
                <li class="{{ $step == 1 ? 'active' : '' }}">Contact</li>
                <li class="{{ $step == 2 ? 'active' : '' }}">Technology or Research</li>
                <li class="{{ $step == 3 ? 'active' : '' }}">Documents</li>
              </ul>
            </div>
            </div>

    @if (!$errors->isEmpty())
    <div class="row">
      <div class="col-xs-12">
        <div class="alert alert-danger">{{ $errors->first() }}</div>
      </div>
    </div>
    @endif

    {{ Form::open([ 'url' => route('store_profile', $step), 'files' => true, 'id' => 'create_profile_form', 'role' => 'form', 'class' => ($step == 1) ? 'form-horizontal' : '' ]) }}

    <input type="hidden" name="id" value="{{$profile->id}}"/>
    <input type="hidden" name="edit" value="{{ Request::segment(1) == 'edit-profile' }}" />

    <div class="create-profile-form">

@yield('form')

      @if ($step == 1)

        <div class="pull-right">
          {{ Form::submit('Save &amp; Next &raquo;', [ 'class' => 'btn btn-primary step1', 'name' => 'next' ] ) }} 
        </div>

      @elseif ($step == 2)
        <ul class="profile-nav pull-right"> 
          <li> 
            {{ Form::submit('&laquo; Previous', [ 'class' => 'btn btn-primary', 'name' => 'previous' ] ) }} 
          </li>
          <li>
            <div class="profile-next">
            {{ Form::submit('Save &amp; Next &raquo;', [ 'class' => 'btn btn-primary step2', 'name' => 'next' ] ) }} 
            </div>
          </li>
        </ul>
      @else
          <ul class="profile-nav pull-right"> 
            <li> 
            {{ Form::submit('&laquo; Previous', [ 'class' => 'btn btn-primary', 'name' => 'previous' ] ) }} 
            </li>
            <li>
              <div class="profile-next">
                <div id="clicker">
                  {{ Form::submit('Publish Profile', [ 'class' => 'btn btn-primary disabled', 'id' => 'submit_profile', 'name' => 'submit' ]) }}
                </div>
              </div>
            </li>
          </ul>
      @endif

    </div>

    {{ Form::close() }}
    
    </div> <!-- /.create-profile -->

  @yield('extra_forms')

@stop

@section('js-head')
  <script type="text/javascript">
    var counts = { 
      'tm_count': {{ Input::old('keypersons') ? (sizeof(Input::old('keypersons')) - 1) : ((empty($profile->keypersons)) ? 0 : sizeof($profile->keypersons) - 1) }}, 
        'photo_count': {{ ((empty($profile->photos) or sizeof($profile->photos) == 0) ? 1 : sizeof($profile->photos)) }},
        'presentation_count': {{ ((empty($profile->presentations) or sizeof($profile->presentations) == 0) ? 0 : sizeof($profile->presentations) - 1) }},
        'publication_count': {{ ((empty($profile->publications) or sizeof($profile->publications) == 0) ? 0 : sizeof($profile->publications) - 1) }},
        'award_count': {{ ((empty($profile->awards) or sizeof($profile->awards) == 0) ? 0 : sizeof($profile->awards) - 1) }}
    };
  </script>
@stop

@section('js-lib')
  {{ HTML::script('js/bootstrap-select.min.js') }}
  {{ HTML::script('//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js') }}
  {{ HTML::script('js/tag-it.min.js') }}
@stop

@section('css')
  {{ HTML::style('css/bootstrap-select.min.css') }}
  {{ HTML::style('css/jquery.tagit.css') }}
  {{ HTML::style('css/tagit.ui-zendesk.css') }}
@stop
