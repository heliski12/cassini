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
            <div class="row">
              <div class="col-md-4">
                <h5>Market sector</h5>
                <div class="row">
                  <div class="form-group">
                    <div class="col-md-12">
                      {{ Form::select('sector_ids[]', SelectHelper::get_sector_options(), null, [ 'class' => 'selectpicker', 'multiple' => 'multiple', 'title' => 'Select all that apply...', 'data-container' => '.marketplace-search', 'data-width' => '100%' ] ) }} 
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <h5>Technology Stage</h5>
                <div class="row">
                  <div class="form-group">
                    <div class="col-md-12">
                      {{ Form::select('product_stage', array_merge(['' => 'Select stage...'], Config::get('cassini.product_stages')), null, [ 'class' => 'selectpicker', 'data-container' => '.marketplace-search', 'data-width' => '100%' ] ) }} 
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <h5>Innovator Type</h5>
                <div class="row">
                  <div class="form-group">
                    <div class="col-md-12">
                      {{ Form::select('innovator_type[]', Config::get('cassini.innovator_search_types'), null, [ 'class' => 'selectpicker', 'multiple' => 'multiple', 'title' => 'Select all that apply...', 'data-container' => '.marketplace-search', 'data-width' => '100%' ] ) }} 
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
                      
                      {{ Form::text('search_term', null, [ 'class' => 'form-control', 'placeholder' => 'Enter search term' ]) }}
                      <span class="input-group-addon">
                        Search 
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
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
              @if (!empty($result->keypersons) and sizeof($result->keypersons) > 0)
                {{ $result->keypersons[0]->full_name }}<br/>
              @endif
              <a href="{{ route('show_profile', [ 'id' => $result->id ]) }}">{{ $result->tech_title }}</a><br/>
              @if ($result->innovator_type === 'RESEARCHER')
                {{ $result->institution->name }}<br/>
                {{ $result->institution_department }}<br/>
              @else
                {{ $result->organization }}<br/>
              @endif
            </div>
            <div class="col-md-5">
              <div class="row">Market Sectors</div>
              <div class="row">Applications</div>
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
