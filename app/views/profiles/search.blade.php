@extends('layouts.private')

@section('content')
<div class="container-full">
  <div class="marketplace">
    <div class="marketplace-search">

    <div class="panel-group" id="search_accordion">
      <div class="panel panel-default">
        <div id="collapse_search" class="panel-collapse collapse in">
          <div class="panel-body">
            <div class="row">
              <div class="col-md-10 col-md-offset-1">
                <h4>Welcome.  You can easily customize your search results.  What are you interested in?</h4>
              </div>
            </div>
            {{ Form::open([ 'url' => route('marketplace'), 'id' => 'marketplace_search', 'role' => 'form', 'method' => 'get' ]) }}
            <div class="row">
              <div class="col-md-4">
                <h5>Market sector</h5>
                <div class="row">
                  <div class="form-group">
                    <div class="col-md-12">
                      {{ Form::select('s[]', SelectHelper::get_sector_options(), Input::old('s[]'), [ 'class' => 'selectpicker', 'multiple' => 'multiple', 'title' => 'Select all that apply...', 'data-container' => '.marketplace-search', 'data-width' => '100%' ] ) }} 
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <h5>Technology Stage</h5>
                <div class="row">
                  <div class="form-group">
                    <div class="col-md-12">
                      {{ Form::select('p[]', Config::get('cassini.product_stages'), Input::old('p[]'), [ 'class' => 'selectpicker', 'multiple' => 'multiple', 'title' => 'Select all that apply...', 'data-container' => '.marketplace-search', 'data-width' => '100%' ] ) }} 
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <h5>Innovator Type</h5>
                <div class="row">
                  <div class="form-group">
                    <div class="col-md-12">
                      {{ Form::select('i[]', Config::get('cassini.innovator_search_types'), Input::old('i[]'), [ 'class' => 'selectpicker', 'multiple' => 'multiple', 'title' => 'Select all that apply...', 'data-container' => '.marketplace-search', 'data-width' => '100%' ] ) }} 
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row search-input">
              <div class="col-md-4">
                <div class="row">
                  <div class="col-md-12">
                    <div class="input-group">
                      {{ Form::text('q', Input::old('q'), [ 'class' => 'form-control', 'placeholder' => 'Enter search term' ]) }}
                      <span class="input-group-btn">
                        {{ Form::submit('Search', [ 'class' => 'btn btn-default', 'id' => 'search' ]) }}
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            {{ Form::close() }}
          </div>
        </div>
        <div class="panel-heading">
          <div class="row">
            <div class="col-md-12">
              <div class="collapse-line">
              </div>
              <div class="collapse-control">
                <h5>
                  <a data-toggle="collapse" data-parent"#search_accordion" href="#collapse_search" class="icon">
                    <span title="Collapse view" class="glyphicon glyphicon-chevron-up"></span>
                  </a>
                </h5>
              </div>
              <div class="collapse-line">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    <div class="marketplace-results">
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <h4>Innovator Listing</h4>
        </div>
      </div>
      @if (!empty($results))
        @foreach ($results as $idx => $result)
          <div class="row marketplace-result">
            <div class="col-md-2">
              <a href="{{ route('show_profile', [ 'id' => $result->id ]) }}"><img class="marketplace-result-img" src="{{ URL::to('/img/blank-avatar.jpg') }}"></img></a>
            </div>
            <div class="col-md-5">
              <a class="title" href="{{ route('show_profile', [ 'id' => $result->id ]) }}">{{ $result->tech_title }}</a><br/>
              @if (!empty($result->keypersons) and sizeof($result->keypersons) > 0)
                {{ $result->keypersons[0]->full_name }}<br/>
              @endif
              @if ($result->innovator_type === 'RESEARCHER')
                {{ $result->institution->name }}<br/>
                {{ $result->institution_department }}<br/>
              @else
                {{ $result->organization }}<br/>
              @endif
            </div>
            <div class="col-md-5">
              <div class="row"><h5>Market Sectors</h5></div>
              <div class="row">
                @foreach ($result->sectors as $sector)
                  <a href="{{ route('marketplace') }}"><span class="label label-primary sector-pill">{{ $sector->name }}</span></a>
                @endforeach
              </div>
              <div class="row"><h5>Applications</h5></div>
              <div class="row">
                @foreach ($result->applications as $application)
                  <a href="{{ route('marketplace') }}"><span class="label label-primary sector-pill">{{ $application->name }}</span></a>
                @endforeach
              </div>
            </div>
          </div>
          @if ($idx < sizeof($results) - 1)
            <div class="row">
              <div class="col-md-12">
                <hr/>
              </div>
            </div>
          @endif
        @endforeach
      @endif
    </div>
  </div>
</div>
@stop


@section('js-lib')
  {{ HTML::script('js/bootstrap-select.min.js') }}
@stop

@section('css')
  {{ HTML::style('css/bootstrap-select.min.css') }}
@stop
