@extends('layouts.master')

@section('title')
{{{ $profile->tech_title }}} | Motionry
@stop

@section('content')


      @if (Session::has('message'))
        <div class="row message">
          <div class="col-md-10 col-md-offset-1">
            <div class="alert alert-success">{{ Session::get('message') }}</div>
          </div>
        </div>
      @endif
      <div class="row">
        <div class="col-md-8 top-buffer">

          <h1>{{{ $profile->tech_title }}}</h1>
      
           <p class="market-sectors">
            @foreach($profile->sectors as $sector)
              <a href="{{ route('marketplace', [ 'm[]' => $sector->id, 'a' => 'Search' ]) }}"><span class="industry">{{ $sector->name }}</span></a>
            @endforeach
          </p> 
        <div class="header-buttons">
            <button class="btn btn-primary btn-sm" type="submit" data-toggle="modal" data-target="#contact">
              
              Contact</button>
            {{ Form::open([ 'url' => route('save_profile'), 'class' => 'save-profile', 'role' => 'form' ]) }}
            {{ Form::hidden('profile_id', $profile->id) }}
            @if ($profile->subscribers->contains(Auth::user()->id))
              <button class="btn btn-sm btn-default disabled" role="button" type="submit">Profile Saved</button>
            @else
              <button class="btn btn-sm btn-default" role="button" type="submit">Save Profile</button>
            @endif
            {{ Form::close() }}
          </div>
          <hr class="horizontal-two">

        <div class="row">
          @if ($profile->innovator_type === 'RESEARCHER')
            <div class="col-xs-3 col-md-2">
                @if (!empty($profile->institution->logo_file_name))
                  <img class="company-img" src="{{ asset($profile->institution->logo->url('small')) }}"/>
                @else
                  <img class="company-img" src="{{ URL::to('/img/company-avatar.png') }}"/>
                @endif
            </div>

            <div class="col-xs-9 col-md-10">
              <h3 class="pitch">
                @if (!empty($profile->institution))
                {{{ $profile->institution->name }}}
                  <br/>
                  {{{ $profile->institution->address }}}
                @endif
              </h3>
            </div>
          @else
            <div class="col-xs-3 col-md-2">
                @if (!empty($profile->institution->logo_file_name))
                  <img class="company-img" src="{{ asset($profile->institution->logo->url('small')) }}"/>
                @else
                  <img class="company-img" src="{{ URL::to('/img/company-avatar.png') }}"/>
                @endif
            </div>

            <div class="col-xs-9 col-md-10">
              <h3 class="pitch">
                {{{ $profile->organization }}}
                @if (!empty($profile->keypersons) and sizeof($profile->keypersons) > 0)
                  <br/>
                  {{{ $profile->keypersons[0]->cityStateCountry }}}
                @endif
              </h3>
            </div>
          @endif
        </div>

        <p class="top-buffer">
          {{ nl2br(e($profile->tech_description)) }}
        </p>

        <p class="top-buffer"><strong>Market Applications:</strong></p>
          @foreach ($profile->applications as $application)
          <div class="industry"><a href="{{ route('marketplace', [ 'q' => $application->name, 'a' => 'Search' ]) }}">{{{ $application->name }}}</a></div>
          @endforeach

                <div class="stages">

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
                    <div id="stage-1" class="stage-title">Experimental</div>
                    <div id="stage-2" class="stage-title">Prototype</div>
                    <div id="stage-3" class="stage-title">Market Pilot</div>
                    <div id="stage-4" class="stage-title">Market&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                  </div>

                </div> 

                <div id = "trademark-patent" class="row stages">
                  <div class="patent-heading">Trademarks</div>
                  <div class="patent-circle-wrap">

                    <div class="patent-circles">
                      <div class="connect outside"></div>
                      <div class="circle-wrap"><div class="circle {{ $profile->ip_trademarks ? 'active' : '' }}"></div></div>
                      <div class="connect"></div>
                      <div class="circle-wrap"><div class="circle {{ (!$profile->ip_trademarks && !$profile->ip_trademarks_pending) ? 'active' : '' }}"></div></div>
                      <div class="connect"></div>
                      <div class="circle-wrap"><div class="circle {{ $profile->ip_trademarks_pending ? 'active' : '' }}"></div></div>
                      <div class="connect outside"></div>
                    </div>

                    <div class="patent-titles">
                      <div class="stage-title" style="text-align: left;">&nbsp;&nbsp;Yes</div>
                      <div class="stage-title" style="text-align: center;">&nbsp;&nbsp;No</div>
                      <div class="stage-title" style="text-align: right;">&nbsp;&nbsp;Pending</div>
                    </div>
                  </div>

                  <div class="patent-heading" id="patent-heading-2">Patents</div>

                  <div class="patent-circle-wrap">

                    <div class="patent-circles">
                      <div class="connect outside"></div>
                      <div class="circle-wrap"><div class="circle {{ $profile->ip_patents ? 'active' : '' }}"></div></div>
                      <div class="connect"></div>
                      <div class="circle-wrap"><div class="circle {{ (!$profile->ip_patents && !$profile->ip_patents_pending) ? 'active' : '' }}"></div></div>
                      <div class="connect"></div>
                      <div class="circle-wrap"><div class="circle {{ $profile->ip_patents_pending ? 'active' : '' }}"></div></div>
                      <div class="connect outside"></div>
                    </div>

                    <div class="patent-titles">
                      <div class="stage-title" style="text-align: left;">&nbsp;&nbsp;Yes</div>
                      <div class="stage-title" style="text-align: center;">&nbsp;&nbsp;No</div>
                      <div class="stage-title" style="text-align: right;">&nbsp;&nbsp;Pending</div>
                    </div>

                  </div>

                </div> 

          <div class="top-buffer">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#website" data-toggle="tab">Website</a></li>
              <li><a href="#publications" data-toggle="tab">Publications</a></li>
              <li><a href="#presentations" data-toggle="tab">Presentations</a></li>
              <li><a href="#awards" data-toggle="tab">Awards</a></li>
            </ul>
            
            <div class="tab-content bottom-buffer">

            <div class="tab-pane fade in active" id="website">
              <div>
                <div class="col-xs-10">
                  @if (!empty($profile->website_clean_url))
                    <a href="{{{ $profile->website_clean_url }}}" target="_blank">
                      @if (!empty($profile->website_title))
                        {{{ $profile->website_title }}}
                      @else
                        {{{ $profile->website_clean_url }}}
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

              <div class="row publication-row">

                @if (!empty($profile->publications) && sizeof($profile->publications) > 0)
                  @foreach ($profile->publications as $idx => $publication)
                    <div class="col-xs-12">
                      <div class="publication-link">
                         @if (!empty($publication->publication) && !empty($publication->publication->name))
                          {{{ $publication->publication->name }}}:&nbsp;&nbsp;
                         @endif       
                         @if (empty($publication->article_clean_url))
                           {{{ $publication->article_title}}} (no weblink provided)
                         @else
                         <a href="{{{ $publication->article_clean_url }}}" target="_blank">
                            {{{ empty($publication->article_title) ? 'View Publication' : $publication->article_title }}} 
                         </a>
                         @endif
                      </div>
                    </div>
                  @endforeach
                @else
                  <div class="col-xs-12">
                    <div class="publication-link">
                      This profile has no publications. 
                    </div>
                  </div>
                @endif

            </div>
          </div>
          
          <div class="tab-pane fade" id="presentations">
            @if (!empty($profile->presentations) && sizeof($profile->presentations) > 0)
              <ul>
                @foreach ($profile->presentations as $presentation)
                  <li>
                    @if (empty($presentation->clean_url))
                      {{{ $presentation->title }}}
                    @else
                      <a href="{{{ $presentation->clean_url }}}" target="_blank">
                        {{{ empty($presentation->title) ? $presentation->clean_url : $presentation->title }}} 
                      </a>
                    @endif 
                  </li>
                @endforeach
              </ul>
            @else
              <p>This profile has no presentations</p>
            @endif
          </div>
              
          <div class="tab-pane fade" id="awards">
            @if (!empty($profile->awards) && sizeof($profile->awards) > 0)
              <ul>
                @foreach ($profile->awards as $award)
                  <li>
                    @if (empty($award->clean_url))
                      {{{ $award->title }}}
                    @else
                      <a href="{{{ $award->clean_url }}}" target="_blank">
                        {{{ empty($award->title) ? $award->clean_url : $award->title }}} 
                      </a>
                    @endif 
                  </li>
                @endforeach
              </ul>
            @else
              <p>This profile has no presentations</p>
            @endif
          </div>
        </div>
            </div> 
          </div>

 <div class="col-xs-12 col-md-4">


          @if (!empty($profile->realPhotos) && sizeof($profile->realPhotos) > 0)

              <div id="carousel" class="carousel slide" data-interval="false">
                <!-- Indicators -->
                @if (sizeof($profile->realPhotos) > 1)
                  <ol class="carousel-indicators">
                    @foreach ($profile->realPhotos as $idx => $photo)
                      <li data-target="#carousel" data-slide-to="{{ $idx }}" class="{{ $idx == 0 ? 'active' : '' }}"></li>
                    @endforeach
                  </ol>
                @endif

                <div class="carousel-inner">
                @foreach ($profile->realPhotos as $idx => $photo)
                  <div class="item {{ $idx == 0 ? 'active' : '' }}">
                    <img src="{{{ asset($photo->photo->url('large')) }}}" class="img-rounded" id="photo_main_img" alt="{{{ $photo->description }}}">
                  </div>
                @endforeach
              </div>

              @if (sizeof($profile->realPhotos) > 1)
                <!-- Controls -->
                <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
              @endif
              </div><!--/#carousel-->

              <span>
              @foreach ($profile->realPhotos as $idx => $photo)
                <div class="photo_main_desc" style="{{ $idx != 0 ? 'display:none;' : '' }}">
                  <p class="desc">{{{ $photo->description }}}</p>
                </div> 
              @endforeach
              </span>
            
        @endif
            
            <div id="key-people" class="top-buffer">
              <h4>Key People</h4>

              <div class="row">

                @foreach ($profile->keypersons as $idx => $keyperson)
                  <div class="col-xs-4 col-sm-3 col-md-4 key-person">
                    <div class="row">
                      <div class="col-xs-12 img-box">
                        @if (empty($keyperson->photo_file_name))
                        <img src="{{ asset('/img/blank-avatar.jpg') }}" alt="{{{ $keyperson->full_name }}}" />
                        @else
                        <img src="{{ asset($keyperson->photo->url('small')) }}" alt="{{{ $keyperson->full_name }}}" />
                        @endif
                      </div>
                      <div class="col-xs-12 text-box">
                        <strong><span class="profile-kp-name">
                            {{{ $keyperson->full_name }}}
                            </span></strong><br/>
                            <span class="profile-kp-title">
                            {{{ $keyperson->title }}}
                            </span>
                      </div>
                    </div>
                  </div>

                  @if ($idx % 3 == 2)
                    <div class="clearfix hidden-sm"></div>
                  @endif

                  @if( $idx % 4 == 3)
                    <div class="clearfix visible-sm"></div>
                  @endif

                @endforeach
              </div>  
            </div>

            <div class="top-buffer">
              <h4>Funding/Strategic Needs</h4>
              <div class="profile-kp bottom-buffer">
                <div class="profile-kp-info">
                   @if (!empty($profile->fs_extra_info))
                     {{ nl2br(e($profile->fs_extra_info)) }}
                   @else
                     No info specified
                   @endif 
                </div> 
              </div>
            </div> 


        </div>

        
        </div>
     </div>

@stop

@section('css')
@stop

@section('js-user')
<script type="text/javascript">
$(function() {
  $(".carousel").on('slide.bs.carousel', function(event) {
      var idx = $(event.relatedTarget).index() + 1
      $(".photo_main_desc").hide();
      $(".photo_main_desc:nth-child("+idx+")").show(500);
  });
});
</script>
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
        Your Message:<br/>
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


