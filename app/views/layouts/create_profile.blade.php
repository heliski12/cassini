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

    </div>

    <div class="form-group">
      <div class="row">
        <div class="col-md-2 col-md-offset-1 col-sm-3">
          @if ($step > 1)
          {{ Form::submit('&lt; Back', [ 'class' => 'btn btn-link', 'name' => 'previous' ] ) }} 
          @else
          &nbsp;
          @endif
        </div>

        <div class="col-md-2 col-md-offset-3 col-sm-3">
          @if ($step < 3)
          {{ Form::submit('Next &gt;', [ 'class' => 'btn btn-link', 'name' => 'next' ] ) }} 
          @else
          &nbsp;
          @endif
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="row">
        <div class="col-md-1 col-md-offset-1 col-sm-2">
          {{ Form::submit('Save Profile', [ 'class' => 'btn btn-primary' ]) }}
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
