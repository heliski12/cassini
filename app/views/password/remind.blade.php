@if (Session::has('status'))
{{ Session::get('status') }}
@endif
@if (Session::has('error'))
{{ Session::get('error') }}
@endif
<form action="{{ action('RemindersController@postRemind') }}" method="POST">
    <input type="email" name="email">
    <input type="submit" value="Send Reminder">
</form>
<a href="{{ URL::to('/') }}">Back to Motionry</a>
