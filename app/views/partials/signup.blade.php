<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  <h4 class="modal-title" id="user_signup_label">Create a Motionry account</h4>
</div>
{{ Form::open( [ 'url' => 'signup', 'id' => 'signup_form', 'role' => 'form' ] ) }}
<div class="modal-body">
  <div class="checkbox">
    <label>
      {{ Form::checkbox('innovator',1,false) }} I'm an Innovator (conduct research or have technology)
    </label>
  </div> 
  <div class="checkbox">
    <label>
      {{ Form::checkbox('seeker',1,false) }} I'm a Seeker (looking for research or technology partners)
    </label>
  </div> 
  <div class="checkbox last">
    <label>
      {{ Form::checkbox('unsure',1,false) }} Unsure and would like to learn more
    </label>
  </div> 
  <div class="form-group {{{ ($errors->has('first_name') ? 'has-error' : '') }}}">
    {{ Form::label('first_name', 'First Name') }}
    @if ($errors->has('first_name'))
        <label class="control-label" for="first_name">{{ $errors->first('first_name') }}</label>
    @endif
    {{ Form::text('first_name',Input::old('first_name'), [ 'class' => 'form-control', 'id' => 'first_name' ]) }}
  </div>
  <div class="form-group {{{ ($errors->has('last_name') ? ' has-error' : '') }}}">
    {{ Form::label('last_name', 'Last Name') }}
    @if ($errors->has('last_name'))
      <label class="control-label" for="first_name">{{ $errors->first('last_name') }}</label>
    @endif
    {{ Form::text('last_name',Input::old('last_name'), [ 'class' => 'form-control', 'id' => 'last_name' ]) }}
  </div>
  <div class="form-group {{{ ($errors->has('organization') ? ' has-error' : '') }}}">
    {{ Form::label('organization', 'Organization') }}
    @if ($errors->has('organization'))
      <label class="control-label" for="first_name">{{ $errors->first('organization') }}</label>
    @endif
    {{ Form::text('organization',Input::old('organization'), [ 'class' => 'form-control', 'id' => 'organization' ]) }}
  </div>
  <div class="form-group {{{ ($errors->has('email') ? ' has-error' : '') }}}">
    {{ Form::label('email', 'Email') }}
    @if ($errors->has('email'))
      <label class="control-label" for="first_name">{{ $errors->first('email') }}</label>
    @endif
    {{ Form::text('email',Input::old('email'), [ 'class' => 'form-control', 'id' => 'email' ]) }}
  </div>
  <div class="form-group {{{ ($errors->has('password') ? ' has-error' : '') }}}">
    {{ Form::label('password', 'Password (case sensitive and must be at least 8 characters in length)') }}
    @if ($errors->has('password'))
      <label class="control-label" for="first_name">{{ $errors->first('password') }}</label>
    @endif
    {{ Form::password('password', [ 'class' => 'form-control', 'id' => 'password' ]) }}
  </div>
  <div class="form-group {{{ ($errors->has('password_confirmation') ? ' has-error' : '') }}}">
    {{ Form::label('password_confirmation', 'Password Confirmation') }}
    @if ($errors->has('password_confirmation'))
      <label class="control-label" for="first_name">{{ $errors->first('password_confirmation') }}</label>
    @endif
    {{ Form::password('password_confirmation', [ 'class' => 'form-control', 'id' => 'password_confirmation' ]) }}
  </div>
  <div class="form-group">
    <p class="help-block">* The Innovator account requires a brief application which will be sent to you shortly.</p> 
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
  {{ Form::button('SIGN UP', [ 'class' => 'btn btn-primary', 'type' => 'submit' ] ) }}
</div>
{{ Form::close() }}

