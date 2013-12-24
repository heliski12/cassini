@extends('layouts.private')

@section('content')


<div class="container-full">
  <div class="my-account">
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <h4>Your Motionry Account</h4>
      </div> 
    </div>

    @if (Session::has('errors'))
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="alert alert-danger">
          {{ Session::get('errors')->first() }} 
        </div>   
      </div>
    </div>
    @endif
    @if (Session::has('message'))
    <div class="row">
      <div class="col-md-10 col-md-offset-1">
        <div class="alert alert-success">
          {{ Session::get('message'); }} 
        </div>   
      </div>
    </div>
    @endif

    <div class="my-account-inner">

      @if (!empty($profiles) and sizeof($profiles) > 0)
        <div class="row">
          <div class="col-md-12">
            <h5>Edit current profiles and add a person to edit profiles.  Note the person added must have an account.</h5>
          </div>
        </div>
        @foreach ($profiles as $profile)
          <div class="row my-profile">
            <div class="col-md-2">
              <img class="my-profiles" src="{{ URL::to('/img/blank-avatar.jpg') }}" />
            </div>
            <div class="col-md-8">
              @if (!empty($profile->keypersons) and sizeof($profile->keypersons) > 0)
                {{ $profile->keypersons[0]->full_name }}<br/>
              @endif
              <a href="{{ route('show_profile', [ 'id' => $profile->id ]) }}">{{ $profile->tech_title }}</a><br/>
              @if ($profile->innovator_type === 'RESEARCHER')
                {{ $profile->institution->name }}<br/>
                {{ $profile->institution_department }}<br/>
              @else
                {{ $profile->organization }}<br/>
              @endif
              <a href="{{ route('edit_profile', [ 'id' => $profile->id ]) }}">Edit</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="{{ route('add_editor', [ 'id' => $profile->id ])}}">Add Secondary Editor</a><br/>
              Status: {{ $profile->status_tos }}
            </div>
          </div>
        @endforeach
      @else
        <div class="row">
          <div class="col-md-12">
            <h5>You have not created ay profiles.</h5>
          </div>
        </div>
      @endif
      <div class="row">
        <div class="col-md-12">
          <hr/>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h5>Add a new profile</h5>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-md-offset-2">
          <a class="btn btn-primary" href="{{ URL::to('/profiles/new') }}">Create Profile</a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <hr/>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h5>Change password</h5>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          {{ Form::open([ 'url' => route('update_password'), 'id' => 'update_password_form', 'role' => 'form', 'class' => 'form-horizontal' ]) }}
          <div class="form-group">
            {{ Form::label('old_password', 'Old Password', [ 'class' => 'col-md-2 control-label' ] ) }} 
            <div class="col-md-4">
              {{ Form::password('old_password') }}
            </div>
          </div>
          <div class="form-group">
            {{ Form::label('new_password', 'New Password', [ 'class' => 'col-md-2 control-label' ] ) }} 
            <div class="col-md-4">
              {{ Form::password('new_password') }}
            </div>
          </div>
          <div class="form-group">
            {{ Form::label('confirm_password', 'Confirm Password', [ 'class' => 'col-md-2 control-label' ] ) }} 
            <div class="col-md-4">
              {{ Form::password('confirm_password') }}
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-offset-2 col-md-4">
              {{ Form::submit('Update', [ 'class' => 'btn btn-primary', 'id' => 'update_password', 'name' => 'submit' ]) }}
            </div> 
          </div>
          {{ Form::close() }}
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <hr/>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h5>Contact Motionry</h5>
        </div>
      </div>
      <div class="row">
        <div class="col-md-offset-2 col-md-4">
          <button class="btn btn-primary" data-toggle="modal" data-target="#contact">Email Motionry</button>
        </div>
      </div>
      <div class="row">
        <div class="col-md-offset-2 col-md-4">
          <h5>(610) 220-0184</h5>
        </div>
      </div>
    </div>
  </div>
</div>


@if (false)
  <div class="container">
    <div class="row my-profiles-new">
      <div class="col-md-2 col-md-offset-1">
        My Profiles 
      </div>
      <div class="col-md-2 col-md-offset-6">
        <a class="btn btn-primary pull-right" href="{{ URL::to('/profiles/new') }}">New Profile</a>
      </div>
    </div>

    @if (!empty($profiles))
      @foreach ($profiles as $profile)
        <div class="row my-profile">
          <div class="col-md-2 col-md-offset-1">
            <img class="my-profiles" src="{{ URL::to('/img/blank-avatar.jpg') }}" />
          </div>
          <div class="col-md-9">
            @if (!empty($profile->keypersons) and sizeof($profile->keypersons) > 0)
              {{ $profile->keypersons[0]->full_name }}<br/>
            @endif
            <a href="{{ route('show_profile', [ 'id' => $profile->id ]) }}">{{ $profile->tech_title }}</a><br/>
            @if ($profile->innovator_type === 'RESEARCHER')
              {{ $profile->institution->name }}<br/>
              {{ $profile->institution_department }}<br/>
            @else
              {{ $profile->organization }}<br/>
            @endif
            <a href="{{ route('edit_profile', [ 'id' => $profile->id ]) }}">Edit</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="{{ route('add_editor', [ 'id' => $profile->id ])}}">Add Secondary Editor</a><br/>
            Status: {{ $profile->status_tos }}
          </div>
        </div>
      @endforeach
    @endif
  </div>
@endif
  
@stop

@section('modal')
<div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="email_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="email_modal_content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="email_label">Contact Motionry</h4>
      </div>
      {{ Form::open([ 'url' => route('email'), 'id' => 'email_form', 'role' => 'form' ]) }}
      <div class="modal-body">
        This private message will be sent to Motionry admins.
        <br/><br/>
        <textarea id="message" name="message" class="form-control" rows="10"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Send Message</button>
      </div>
      {{ Form::close() }}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop
