<img src="{{ asset($publication->photo->url('small')) }}"/>
<img src="{{ asset($publication->photo->url('original')) }}"/>
{{ Form::open(['url' => route('save_publication_photo'), 'method' => 'post', 'files' => true]) }}
{{ Form::hidden('id',$publication->id) }}
Upload new photo:
{{ Form::file('photo') }}
{{ Form::submit('Upload') }}
{{ Form::close() }}
<br/>
<br/>
<a href="{{ URL::to('/admin/publications') }}">return to main admin page</a>

