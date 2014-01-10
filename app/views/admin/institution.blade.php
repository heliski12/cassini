<img src="{{ asset($institution->logo->url('small')) }}"/>
<img src="{{ asset($institution->logo->url('original')) }}"/>
{{ Form::open(['url' => route('save_institution_logo'), 'method' => 'post', 'files' => true]) }}
{{ Form::hidden('id',$institution->id) }}
Upload new logo:
{{ Form::file('logo') }}
{{ Form::submit('Upload') }}
{{ Form::close() }}
<br/>
<br/>
<a href="{{ URL::to('/admin/institutions') }}">return to main admin page</a>
