@if (Session::has('error'))
{{ Session::get('error') }}
@endif
<form action="{{ action('RemindersController@postReset') }}" method="POST">
    <input type="hidden" name="token" value="{{ $token }}">
    Email:<input type="email" name="email">
    Password:<input type="password" name="password">
    Password Confirmation:<input type="password" name="password_confirmation">
    <input type="submit" value="Reset Password">
</form>
<a href="{{ URL::to('/') }}">Back to Motionry</a>
