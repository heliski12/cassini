@extends('layouts.private')

@section('content')

  <div class="container-full create-profile">
    <div class="row">
      <div class="col-md-11 col-md-offset-1">
        <h4>Welcome and let's start creating your profile.</h4>
      </div> 
    </div>
    <div class="row">
      <div class="col-md-1 col-md-offset-1 col-sm-2 step {{ $step == 1 ? 'step-active' : '' }}">
        <h3>Step 1</h3>
        General Info 
      </div>
      <div class="col-md-1 col-sm-2 step {{ $step == 2 ? 'step-active' : '' }}">
        <h3>Step 2</h3>
        Technology Info 
      </div>
      <div class="col-md-1 col-sm-2 step {{ $step == 3 ? 'step-active' : '' }}">
        <h3>Step 3</h3>
        Supporting Info 
      </div>
    </div>

    {{ Form::open([ 'url' => route('store_profile', $step), 'id' => 'create_profile_form', 'role' => 'form' ]) }}

@yield('form')

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

  </div><!-- /.container-full -->

@stop
