@extends('layouts.master')

@section('content')

        <h1>My Motionry Account</h1>

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

        @if (!empty($profiles) and sizeof($profiles) > 0)
        <p>Edit current profiles and add a person to edit profiles.  Note the person added must have an account.</p>

        @foreach ($profiles as $profile)
          <div class="row top-buffer">

            <div class=" col-xs-12 col-sm-2 ">
              @if (!empty($profile->keypersons) and sizeof($profile->keypersons) > 0 and !empty($profile->keypersons[0]->photo_file_name))
                <img class="marketplace-result-img" src="{{ asset($profile->keypersons[0]->photo->url('small')) }}"></img>
              @else
                <img class="marketplace-result-img" src="{{ URL::to('/img/blank-avatar.png') }}"></img>
              @endif
            </div>

            <div class="col-xs-12 col-sm-8">
              @if (!empty($profile->keypersons) and sizeof($profile->keypersons) > 0)
                {{ $profile->keypersons[0]->full_name }}<br/>
              @endif
              @if ($profile->innovator_type === 'RESEARCHER')
                @if (!empty($profile->institution) && !empty($profile->institution->name))
                  {{ $profile->institution->name }}<br/>
                  {{ $profile->institution_department }}<br/>
                @endif
              @elseif (!empty($profile->organization))
                {{ $profile->organization }}<br/>
              @endif
              Status: {{ $profile->status_tos }}<br/>
              <a href="{{ route('edit_profile', [ 'id' => $profile->id ]) }}">Edit</a>&nbsp;&nbsp;|&nbsp;&nbsp;Secondary Editors:
             <span class="secondary-editors">
                @include('partials.secondary_editors', [ 'profile' => $profile ])
             </span>

              {{ Form::open([ 'url' => route('add_editor'), 'class' => 'add-editor-form', 'role' => 'form' ]) }}
              <div class="row">
                <div class="col-md-7 col-sm-9 col-xs-9">
                  <div class="input-group add-secondary-editor">
                    {{ Form::hidden('profile_id', $profile->id) }}
                    {{ Form::text('email', null, [ 'class' => 'form-control input-sm', 'placeholder' => 'Email address of secondary editor...' ]) }}
                    <span class="input-group-btn">
                      {{ Form::submit('Add secondary editor', [ 'class' => 'btn btn-primary btn-sm' ]) }}
                    </span>
                  </div>
                </div>
              </div> 
            {{ Form::close() }}

            </div>
          </div><!--editor 1-->
        @endforeach
        @else
          <div class="col-xs-12">
            @if (Auth::user()->innovator)
              <h5>You have not created any profiles.</h5>
            @else
              <h5>You have not been added as an editor on any profiles.</h5>
            @endif
          </div>
        @endif

       <hr/>


      @if (Auth::user()->innovator)
      <h5>Add a new profile</h5>

      <p><a class="btn btn-primary" href="{{ URL::to('/profiles/new') }}">Create Profile</a></p>

      <hr/>
      @endif


      <h5>Change password (case sensitive and must be at least 8 characters in length)</h5>

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
      </div> <!-- row -->

        
        <hr/>
       
       
       <h5>Contact Motionry</h5>
        
      
      <button class="btn btn-primary bottom-buffer" data-toggle="modal" data-target="#contact">Email Motionry</button>

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
        This message will be sent to Motionry.  How can we help you?
        <br/><br/>
        Your Message:<br/>
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
