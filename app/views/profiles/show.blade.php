@extends('layouts.private')

@section('content')

<div class="container-full">
  @if (Session::has('message'))
    <div class="row message">
      <div class="col-md-10 col-md-offset-1">
        <div class="alert alert-success">{{ Session::get('message') }}</div>
      </div>
    </div>
  @endif
  <div class="row profile-wrap">
      <div class="row profile-top">
        <div class="col-md-2 profile-inst">
          @if ($profile->innovator_type === 'RESEARCHER')
            <div class="profile-logo">
              @if (!empty($profile->institution->logo_file_name))
                <img src="{{ asset($profile->institution->logo->url('small')) }}"/>
              @else
                <img src="{{ URL::to('/img/company-avatar.png') }}"/>
              @endif
            </div>
            <div class="profile-inst-det">
              @if (!empty($profile->institution))
                {{ $profile->institution->name }}<br/>
                {{ $profile->institution->address }}
              @endif
            </div>
          @else
            <div class="profile-logo">
              @if (!empty($profile->organization_logo_file_name))
                <img src="{{ asset($profile->organization_logo->url('small')) }}"/>
              @else
                <img src="{{ URL::to('/img/company-avatar.png') }}"/>
              @endif
            </div>
            <div class="profile-inst-det">
              {{ $profile->organization }}<br/>
              @if (!empty($profile->keypersons) and sizeof($profile->keypersons) > 0)
                {{ $profile->keypersons[0]->cityStateCountry }}
              @endif
            </div>
          @endif
        </div>
        <div class="col-md-7 profile-top-cell">
          <div class="tech-title">
            {{ $profile->tech_title }}
          </div>
          <div class="market-sectors">
            @foreach ($profile->sectors as $sector)
            <a href="{{ route('marketplace', [ 'm[]' => $sector->id, 'a' => 'Search' ]) }}"><span class="label label-primary sector-pill">{{ $sector->name }}</span></a>
            @endforeach
          </div>
        </div>
        <div class="col-md-3">
          <button class="btn btn-warning btn-first col-md-12" data-toggle="modal" data-target="#contact">Contact Motionry about this Profile</button>
          {{ Form::open([ 'url' => route('save_profile'), 'id' => 'contact_form', 'role' => 'form' ]) }}
          {{ Form::hidden('profile_id', $profile->id) }}
          @if ($profile->subscribers->contains(Auth::user()->id))
            <button class="btn btn-warning btn-last disabled col-md-12" type="submit">Profile Saved</button>
          @else
            <button class="btn btn-warning btn-last col-md-12" type="submit">Save Profile</button>
          @endif
          {{ Form::close() }}
        
        </div>
      </div>
      <div class="row profile-body">
        <div class="row">
          <div class="col-md-7">
            @if (!empty($profile->photos) and sizeof($profile->photos) > 0 and !empty($profile->photos[0]->photo_file_name))
              <div class="row profile-body-cell">
                <div class="row">
                  <div class="col-md-12 photo-main">
                    <img src="{{ asset($profile->photos[0]->photo->url('large')) }}" class="img-rounded" id="photo_main_img" alt="{{ $profile->photos[0]->description }}" />
                  </div> 
                </div>
                @if (!empty($profile->photos[0]->description))
                  <div class="row">
                    <div class="col-md-12" id="photo_main_desc">
                      {{ $profile->photos[0]->description }} 
                    </div> 
                  </div>
                @endif
                @if (sizeof($profile->photos) > 1)
                <div class="row">
                  <div class="col-md-12">
                    <div id="photo_carousel" class="carousel slide" data-interval="9999999999999">
                      <div class="carousel-inner">
                        @foreach($profile->photos as $idx => $photo)
                          @if ($idx === 0 or $idx % 4 === 0)
                            <div class="item {{ $idx === 0 ? 'active' : '' }}">
                              <div class="row">
                          @endif
                            <div class="col-md-3 col-sm-3 col-xs-3">
                              <a href="#" class="carousel-thumb" lg="#photo_{{ $photo->id }}_lg" >
                                <img class="img-responsive img-thumbnail" src="{{ asset($photo->photo->url('thumb')) }}" alt="{{ $photo->description }}" />
                                <img style="display:none;" src="{{ asset($photo->photo->url('large')) }}" id="photo_{{ $photo->id }}_lg" alt="{{ $photo->description }}" />
                              </a>
                            </div>
                          @if ($idx % 4 === 3 or $idx === sizeof($profile->photos) - 1)
                              </div>
                            </div>
                          @endif
                        @endforeach
                      </div>
                      @if (sizeof($profile->photos) > 4)
                        <a class="left" href="#photo_carousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                        <a class="right" href="#photo_carousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
                      @endif
                    </div>
                  </div> 
                </div>
              @endif
              </div> 
            @endif
            <div class="row profile-body-cell">
              <div class="col-md-12">
                <div class="row stages">
                  <div class="stage-circles">
                    <div class="connect outside"></div>
                    <div class="circle-wrap"><div class="circle {{ $profile->product_stage === 'EXPERIMENTAL' ? 'active' : '' }}"></div></div>
                    <div class="connect"></div>
                    <div class="circle-wrap"><div class="circle {{ $profile->product_stage === 'PROTOTYPE' ? 'active' : '' }}"></div></div>
                    <div class="connect"></div>
                    <div class="circle-wrap"><div class="circle {{ $profile->product_stage === 'MARKET_PILOT' ? 'active' : '' }}"></div></div>
                    <div class="connect"></div>
                    <div class="circle-wrap"><div class="circle {{ $profile->product_stage === 'MARKET' ? 'active' : '' }}"></div></div>
                    <div class="connect outside"></div>
                  </div>
                  <div class="stage-titles">
                    <div class="stage-title" style="text-align: left;">Experimental</div>
                    <div class="stage-title" style="text-align: center;">Prototype&nbsp;&nbsp;&nbsp;&nbsp;</div>
                    <div class="stage-title" style="text-align: center;">&nbsp;&nbsp;&nbsp;&nbsp;Market Pilot</div>
                    <div class="stage-title" style="text-align: right;">Market&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                  </div>
                </div> 
              </div>
              <div class="col-md-12">
                <div class="row stages">
                  <div class="patent-heading">Trademarks</div>
                  <div class="patent-circle-wrap">
                    <div class="patent-circles">
                      <div class="connect outside"></div>
                      <div class="circle-wrap"><div class="circle {{ ($profile->ip_trademarks) ? 'active' : '' }}"></div></div>
                      <div class="connect"></div>
                      <div class="circle-wrap"><div class="circle {{ (!$profile->ip_trademarks) ? 'active' : '' }}"></div></div>
                      <div class="connect"></div>
                      <div class="circle-wrap"><div class="circle {{ $profile->ip_trademarks_pending ? 'active' : '' }}"></div></div>
                      <div class="connect outside"></div>
                    </div>
                    <div class="patent-titles">
                      <div class="stage-title" style="text-align: left;">&nbsp;&nbsp;Yes</div>
                      <div class="stage-title" style="text-align: center;">&nbsp;&nbsp;No</div>
                      <div class="stage-title" style="text-align: right;">Pending</div>
                    </div>
                  </div>
                  <div class="patent-heading">Patents</div>
                  <div class="patent-circle-wrap">
                    <div class="patent-circles">
                      <div class="connect outside"></div>
                      <div class="circle-wrap"><div class="circle {{ ($profile->ip_patents) ? 'active' : '' }}"></div></div>
                      <div class="connect"></div>
                      <div class="circle-wrap"><div class="circle {{ (!$profile->ip_patents) ? 'active' : '' }}"></div></div>
                      <div class="connect"></div>
                      <div class="circle-wrap"><div class="circle {{ $profile->ip_patents_pending ? 'active' : '' }}"></div></div>
                      <div class="connect outside"></div>
                    </div>
                    <div class="patent-titles">
                      <div class="stage-title" style="text-align: left;">&nbsp;&nbsp;Yes</div>
                      <div class="stage-title" style="text-align: center;">&nbsp;&nbsp;No</div>
                      <div class="stage-title" style="text-align: right;">Pending</div>
                    </div>
                  </div>
                </div> 
              </div>
            </div> 
            <div class="row profile-body-cell">
              <div class="col-md-12">
                <div class="row profile-description">
                  {{ $profile->tech_description }}
                </div>
                <div class="row profile-description">
                  <div class="profile-h">Market Applications</div>
                    @foreach ($profile->applications as $application)
                      <a href="{{ route('marketplace', [ 'q' => $application->name, 'a' => 'Search' ]) }}"><span class="label label-primary sector-pill">{{ $application->name }}</span></a>
                    @endforeach
                </div>
              </div>
            </div> 
          </div>
          <div class="col-md-5">
            <div class="row profile-body-cell">
              <div class="profile-h">Key People</div>
              @foreach ($profile->keypersons as $keyperson)
                <div class="row profile-kp">
                  <div class="col-md-3 col-sm-2 col-xs-3">
                    @if (empty($keyperson->photo_file_name))
                      <img src="{{ URL::to('/img/blank-avatar.jpg') }}"/> 
                    @else
                      <img src="{{ asset($keyperson->photo->url('small')) }}"/> 
                    @endif
                  </div>
                  <div class="col-md-9 col-sm-10 col-xs-9 profile-kp-info">
                    <span class="profile-kp-name">
                      {{ $keyperson->full_name }}
                    </span><br/>
                    <span class="profile-kp-title">
                      {{ $keyperson->title }}  
                    </span>
                  </div>
                </div>
              @endforeach
            </div> 
            <div class="row profile-body-cell">
              <div class="profile-h">Funding</div>
              <div class="row profile-kp">
                <div class="col-md-12 profile-kp-info">
                  @if (!empty($profile->fs_extra_info))
                    {{ $profile->fs_extra_info }} 
                  @else
                    No info specified
                  @endif
                </div> 
              </div>
            
            </div> 
          </div>
        </div>
        <div class="row profile-tabs">
          <div class="col-md-12">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#website" data-toggle="tab">Website</a></li>
              <li><a href="#publications" data-toggle="tab">Publications</a></li>
              <li><a href="#presentations" data-toggle="tab">Presentations</a></li>
              <li><a href="#awards" data-toggle="tab">Awards</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane fade in active" id="website">
                <div class="row">
                  <div class="col-md-10">
                    @if (!empty($profile->website_clean_url))
                    <a href="{{ $profile->website_clean_url }}" target="_blank">
                      @if (!empty($profile->website_title))
                        {{ $profile->website_title }}<br/>
                      @else
                        {{ $profile->website_clean_url }}
                      @endif
                    </a>
                    @else
                      No website provided
                    @endif
                  </div>
                </div>
                <div class="row">&nbsp;</div>
              </div>
              <div class="tab-pane fade" id="publications">
                @if (!empty($profile->publications))
                  @foreach ($profile->publications as $idx => $publication)
                    @if ($idx % 4 === 0)
                      <div class="row publication-row">
                    @endif
                      <div class="col-md-3">
                        <div class="row">
                          @if (!empty($publication->publication) and !empty($publication->publication->photo_file_name))
                            <img src="{{ asset($publication->publication->photo->url('small')) }}" /> 
                          @else
                            <img src="{{ URL::to('/img/publication.png') }}" /> 
                          @endif
                        </div>
                        <div class="row publication-link">
                          @if (empty($publication->article_clean_url))
                            {{ $publication->article_title }}
                          @else
                          <a href="{{ $publication->article_clean_url }}">{{ (empty($publication->article_title) ? 'View Publication' : $publication->article_title) }}</a> 
                          @endif
                        </div>
                      </div>
                    @if ($idx % 4 === 3 or $idx === sizeof($profile->publications) - 1)
                      </div>
                    @endif
                  @endforeach
                @else
                  <div class="row">
                    <div class="col-md-10">
                      This profile has no publications. 
                    </div> 
                  </div>
                  <div class="row">&nbsp;</div>
                @endif
              </div>
              <div class="tab-pane fade" id="presentations">
                  @if (!empty($profile->presentations) and sizeof($profile->presentations) > 0)
                    <ul>
                    @foreach ($profile->presentations as $presentation)
                      <li>
                        @if (empty($presentation->clean_url))
                          {{ $presentation->title }}
                        @else
                        <a href="{{ $presentation->clean_url }}">{{ (empty($presentation->title) ? $presentation->clean_url : $presentation->title) }}</a>
                        @endif
                      </li>
                    @endforeach 
                    </ul> 
                  @else
                    <div class="row">
                      <div class="col-md-10">
                        This profile has no presentations. 
                      </div> 
                    </div>
                    <div class="row">&nbsp;</div>
                  @endif
              </div>
              <div class="tab-pane fade" id="awards">
                  @if (!empty($profile->awards) and sizeof($profile->awards) > 0)
                    <ul>
                    @foreach ($profile->awards as $award)
                      <li>
                        @if (empty($award->clean_url))
                        {{ $award->title }}
                        @else
                          <a href="{{ $award->clean_url }}">{{ (empty($award->title) ? $award->clean_url : $award->title) }}</a>
                        @endif
                      </li>
                    @endforeach 
                    </ul> 
                  @else
                    <div class="row">
                      <div class="col-md-10">
                        This profile has no awards. 
                      </div> 
                    </div>
                    <div class="row">&nbsp;</div>
                  @endif
              </div>
            </div>
          </div> 
        </div>
      </div>
  </div>

</div>

@stop

@section('css')
@stop

@section('js-lib')
@stop

@section('modal')
<div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="contact_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="contact_modal_content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="contact_label">Contact Motionry about this profile</h4>
      </div>
      {{ Form::open([ 'url' => route('contact'), 'id' => 'contact_form', 'role' => 'form' ]) }}
      <div class="modal-body">
        This message regarding '<strong>{{ $profile->tech_title }}</strong>' will be sent to Motionry.  Please let us know what action you would like us to take, such as having the team on the profile contact you directly.
        <br/><br/>
        <textarea id="message" name="message" class="form-control" rows="10"></textarea>
        {{ Form::hidden('profile_id', $profile->id) }}
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


