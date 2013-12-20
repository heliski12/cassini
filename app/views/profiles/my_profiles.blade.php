@extends('layouts.private')

@section('content')

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
          <div class="col-md-6">
            @if (!empty($profile->keypersons) and sizeof($profile->keypersons) > 0)
              {{ $profile->keypersons[0]->full_name }}<br/>
            @endif
            <a href="{{ route('show_profile', [ 'id' => $profile->id ]) }}">{{ $profile->tech_title }}</a><br/>
            @if (!empty($profile->institution))
              {{ $profile->institution->name }}<br/>
              {{ $profile->institution_department }}<br/>
            @else
              {{ $profile->organization }}<br/>
            @endif
            <a href="{{ route('edit_profile', [ 'id' => $profile->id ]) }}">Edit</a>
          
          </div>
        </div>
      @endforeach
    @endif
  </div>
  
@stop
