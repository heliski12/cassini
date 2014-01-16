@extends('layouts.private')

@section('content')

  <div class="container authorization">
    <div class="row">
      <div class="col-sm-12">
        Thank you for signup up.  We will contact you shortly for access.  <a href="{{ URL::to('/logout') }}">Log out</a>
      </div>
    </div>
  </div>
@stop
