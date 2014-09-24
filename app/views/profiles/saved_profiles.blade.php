@extends('layouts.master')

@section('content')

      <h1 class="welcome">Saved Profiles</h1>
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
          <p>Click on box next to each profile and then Contact Motionry.  The team on the profile will contact you directly.</p>

        <p>
          <button class="btn btn-primary bottom-buffer saved-profile-contact" data-toggle="modal" data-target="#contact">Contact Motionry</button>
        </p>

        @foreach ($profiles as $profile)
          <div class="panel panel-default my-profile">
          <div class="panel-body">
          <div class="panel-nav"></div>
          
          <div class="row saved-profile-controls">
              <div class="col-xs-6 pull-left checkbox">
                {{ Form::checkbox('select_'.$profile->id,'select_'.$profile->id, false, [ 'class' => 'contact-select', 'id' => $profile->id ]) }} 
                {{ Form::hidden('id_'.$profile->id, $profile->id, [ 'id' => 'id_'.$profile->id ]) }} 
                {{ Form::hidden('name_'.$profile->id, $profile->tech_title, [ 'id' => 'name_'.$profile->id ]) }} 
              </div>
              <div class="col-xs-6 pull-right remove">
              <a href="#" class="icon remove-sp" pid="{{ $profile->id }}" title="Delete saved profile"><span class="glyphicon glyphicon-remove"></span></a>
              </div>
          </div>
          <div class="row profile-content">
            <div class="col-xs-4 col-sm-2">
              <a href="{{ route('show_profile', [ 'id' => $profile->id ]) }}">
                @if (!empty($profile->keypersons) and sizeof($profile->keypersons) > 0)
                  <img class="my-profiles" src="{{ asset($profile->keypersons[0]->photo->url('small')) }}" />
                @else
                  <img class="my-profiles" src="{{ URL::to('/img/blank-avatar.png') }}" />
                @endif
              </a>
            </div>
            <div class="col-xs-8 col-sm-6">
              @if (!empty($profile->keypersons) and sizeof($profile->keypersons) > 0)
                {{ $profile->keypersons[0]->full_name }}<br/>
              @endif
              <a href="{{ route('show_profile', [ 'id' => $profile->id ]) }}">{{ $profile->tech_title }}</a><br/>
              @if ($profile->innovator_type === 'RESEARCHER')
                @if (!empty($profile->institution))
                  {{ $profile->institution->name }}<br/>
                  {{ $profile->institution_department }}<br/>
                @endif
              @else
                {{ $profile->organization }}<br/>
              @endif
            </div>
              
          </div> <!-- profile-content -->
        </div> <!-- panel-body -->
        </div> <!-- panel-default -->
      @endforeach
    @else <!-- profiles -->
      <div class="col-md-12">
        <h5>You have not saved any profiles.</h5>
      </div>
    @endif <!-- profiles -->
@stop

@section('modal')
<div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="email_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="email_modal_content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="email_label">Contact Motionry</h4>
      </div>
      {{ Form::open([ 'url' => route('contact_multiple'), 'id' => 'contact_multiple_form', 'role' => 'form' ]) }}
      {{ Form::hidden('profile_ids',null, [ 'id' => 'profile_ids' ]) }}
      <div class="modal-body">
        This private message regarding the following profiles will be sent to Motionry:
        <br/>
        <br/>
        <ul id="message_profiles">
        </ul>
        Please let us know what action you would like us to take, such as having the team on the profile contact you directly.<br/><br/>
        Your Message:<br/>
        <textarea id="message" name="message" class="form-control" rows="10"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Send Message</button>
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>
@stop
