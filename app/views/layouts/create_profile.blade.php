@extends('layouts.private')

@section('content')

  <div class="container-full">
    <div class="create-profile">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <h4>Welcome to the private beta.  You are just minutes away from establishing your profile.</h4>
      </div> 
    </div>
    <div class="row">
      <div class="col-md-8 col-md-offset-2 steps-nav">
        <ul class="steps">
          <li class="{{ $step == 1 ? 'active' : '' }}">1</li>
          <li class="{{ $step == 2 ? 'active' : '' }}">2</li>
          <li class="{{ $step == 3 ? 'active' : '' }}">3</li>
        </ul>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8 col-md-offset-2 steps-nav">
          <ul class="step-titles">
            <li class="{{ $step == 1 ? 'active' : '' }}">Contact</li>
            <li class="{{ $step == 2 ? 'active' : '' }}">Technology or Research</li>
            <li class="{{ $step == 3 ? 'active' : '' }}">Documents</li>
          </ul>
      </div>
    </div>

    {{ Form::open([ 'url' => route('store_profile', $step), 'id' => 'create_profile_form', 'role' => 'form', 'class' => ($step == 1) ? 'form-horizontal' : '' ]) }}
    {{-- Form::model($profile, [ 'route' => ['store_profile', $step ], 'id' => 'create_profile_form', 'role' => 'form', 'class' => 'form-horizontal' ]) --}}

    <div class="create-profile-form">

@yield('form')

      <div class="form-group">
        <div class="row">
          <div class="col-md-2 col-md-offset-1">
            @if ($step > 1)
            {{ Form::submit('&laquo; Previous', [ 'class' => 'btn btn-primary', 'name' => 'previous' ] ) }} 
            @else
            &nbsp;
            @endif
          </div>

          <div class="col-md-2 col-md-offset-6 profile-next">
            @if ($step < 3)
              {{ Form::submit('Save &amp; Next &raquo;', [ 'class' => 'btn btn-primary step' . $step, 'name' => 'next' ] ) }} 
            @else
              {{ Form::submit('Save Profile', [ 'class' => 'btn btn-primary' ]) }}
            @endif
          </div>
        </div>
      </div>

    </div>



    {{ Form::close() }}
    
    </div> <!-- /.create-profile -->
  </div><!-- /.container-full -->

@stop

@section('js-lib')
  {{ HTML::script('js/bootstrap-select.min.js') }}
@stop

@section('css')
  {{ HTML::style('css/bootstrap-select.min.css') }}
@stop
