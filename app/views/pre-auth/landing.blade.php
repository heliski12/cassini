@extends('layouts.master')

@section('content')

  <div class="container authorization">
    <div class="row">
      <div class="col-sm-12">
        Thank you for signup up.  We will contact you shortly for access to the Marketplace.  <a href="{{ URL::to('/') }}">Return Home</a>
      </div>
    </div>
  </div>
@stop
