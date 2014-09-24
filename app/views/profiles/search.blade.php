@extends('layouts.master')

@section('title')
 Motionry Innovators
@stop

@section('content')

  <div class="marketplace">
    <div class="marketplace-search">

    <div class="panel-group" id="search_accordion">
      <div class="panel panel-default">
        <div id="collapse_search" class="panel-collapse collapse in">
          <div class="panel-body">
           <h1 class="welcome">Welcome. You can easily customize your search results.</h1>  
             {{ Form::open([ 'url' => route('marketplace'), 'id' => 'marketplace_search', 'role' => 'form', 'method' => 'get', 'class' => 'top-buffer' ]) }}
              <div class="row">
              <div class="col-md-4">
                <h5>Market sector</h5>
                <div class="row">
                  <div class="form-group">
                    <div class="col-md-12">
                      {{ Form::select('m[]', SelectHelper::get_sector_options(), Input::old('m[]') ?: (isset($saved_input['m']) ? $saved_input['m'] : null), [ 'class' => 'selectpicker', 'multiple' => 'multiple', 'title' => 'Select all that apply...', 'data-container' => '.marketplace-search', 'data-width' => '100%' ] ) }} 
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <h5>Technology Stage</h5>
                <div class="row">
                  <div class="form-group">
                    <div class="col-md-12">
                      {{ Form::select('p[]', Config::get('cassini.product_stages'), Input::old('p[]') ?: (isset($saved_input['p']) ? $saved_input['p'] : null), [ 'class' => 'selectpicker', 'multiple' => 'multiple', 'title' => 'Select all that apply...', 'data-container' => '.marketplace-search', 'data-width' => '100%' ] ) }} 
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <h5>Innovator Type</h5>
                <div class="row">
                  <div class="form-group">
                    <div class="col-md-12">
                      {{ Form::select('i[]', Config::get('cassini.innovator_search_types'), Input::old('i[]') ?: (isset($saved_input['i']) ? $saved_input['i'] : null), [ 'class' => 'selectpicker', 'multiple' => 'multiple', 'title' => 'Select all that apply...', 'data-container' => '.marketplace-search', 'data-width' => '100%' ] ) }} 
                    </div>
                  </div>
                </div>
              </div>
            </div> <!-- row -->
            <div class="row search-input">
              <div class="col-md-4">
                <div class="row">
                  <div class="col-md-12">
                    <div class="input-group">
                      {{ Form::text('q', Input::old('q') ?: (isset($saved_input['q']) ? $saved_input['q'] : null), [ 'class' => 'form-control', 'placeholder' => 'Enter search term' ]) }}
                      <span class="input-group-btn">
                        {{ Form::submit('Search', [ 'class' => 'btn btn-default', 'id' => 'search', 'name' => 'a' ]) }}
                      </span>
                    </div>
                  </div>
                </div>
              </div> <!-- col-md-4 -->
              <div class="col-md-4">
                <div class="row">
                  <div class="col-md-12 clear-fields">
                    <a href="#" id="clear_fields">Clear search fields</a>
                  </div>
                </div>
              </div>
            </div>
            {{ Form::close() }}
          </div> <!-- panel-body -->
        </div> <!-- collapse-search -->
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
        </div> <!-- panel-heading -->
      </div> <!-- panel-default -->
    </div> <!-- panel-group -->
  </div> <!-- marketplace-search -->
    <div class="marketplace-results">
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <h2>Innovator Listing</h2>
        </div>
      </div> <!-- row -->
        @if (!empty($results) && sizeof($results) > 0)
         <div class="pagination-align">
          {{ $results->links('partials.pagination') }}
         </div> <!-- pagination-align -->
          @foreach ($results as $idx => $result)
        <div class="row marketplace-result">
          <div class="col-md-1 col-sm-2 col-xs-12">
            <a href="{{ route('show_profile', [ 'id' => $result->id ]) }}">
              @if (!empty($result->keypersons) and sizeof($result->keypersons) > 0)
                <img class="marketplace-result-img" src="{{ asset($result->keypersons[0]->photo->url('small')) }}"></img>
              @else
                <img class="marketplace-result-img" src="{{ URL::to('/img/blank-avatar.png') }}"></img>
              @endif
            </a>
          </div> <!-- col-md-1 -->
          <div class="col-md-5 col-sm-5 col-xs-12 kp-name">
            <a class="title" href="{{ route('show_profile', [ 'id' => $result->id ]) }}">{{ $result->tech_title }}</a><br/>
            @if (!empty($result->keypersons) and sizeof($result->keypersons) > 0)
              {{ $result->keypersons[0]->full_name }}<br/>
            @endif
            @if ($result->innovator_type === 'RESEARCHER')
              @if (!empty($result->institution))
                {{ $result->institution->name }}<br/>
                {{ $result->institution_department }}<br/>
              @endif
            @else
              {{ $result->organization }}<br/>
            @endif
          </div> <!-- kp-name -->
            <div class="col-md-5 col-sm-4 col-xs-12">
              <h5 class="top-sm-buffer">Market Sectors</h5>
              <div>
                @foreach ($result->sectors as $sector)
                <a href="{{ route('marketplace', [ 'm[]' => $sector->id, 'a' => 'Search' ]) }}"><span class="industry">{{ $sector->name }}</span></a>
                @endforeach
              </div>
              <div><h5 class="top-sm-buffer">Applications</h5></div>
              <div>
                @foreach ($result->applications as $application)
                <a href="{{ route('marketplace', [ 'q' => $application->name, 'a' => 'Search' ]) }}"><span class="industry">{{ $application->name }}</span></a>
                @endforeach
              </div>
            </div> <!-- col-md-5 -->
          </div> <!-- marketplace-result -->
            @endforeach

            <div class="pagination-align">
                {{ $results->links('partials.pagination') }}
            </div> <!-- pagination-align -->
            @else  <!-- results -->
            <div class="col-xs-12">
              No results found! 
            </div>
            @endif <!-- results -->
          </div> <!-- marketplace-results -->
          
        </div> <!-- marketplace -->

@stop


@section('js-lib')
  {{ HTML::script('js/bootstrap-select.min.js') }}
@stop

@section('css')
  {{ HTML::style('css/bootstrap-select.min.css') }}
@stop
