<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  <h4 class="modal-title" id="user_signup_label">CREATE A MOTIONRY ACCOUNT</h4>
</div>
{{ Form::open( [ 'url' => 'signup', 'id' => 'signup_form', 'role' => 'form' ] ) }}
<div class="modal-body">
  <div class="checkbox">
    <label>
      {{ Form::checkbox('innovator','innovator',false) }} I'm an Innovator (conduct research or have technology)
    </label>
  </div> 
  <div class="checkbox">
    <label>
      {{ Form::checkbox('seeker','seeker',false) }} I'm a Seeker (looking for partners)
    </label>
  </div> 
  <div class="checkbox last">
    <label>
      {{ Form::checkbox('unsure','unsure',false) }} Unsure and would like to learn more
    </label>
  </div> 
  <div class="form-group">
    {{ Form::label('first_name', 'First Name') }}
    @if ($errors->has('first_name'))
      <div class="error-message">
        {{ $errors->first('first_name') }}
      </div>
    @endif
    {{ Form::text('first_name',Input::old('first_name'), [ 'class' => 'form-control' . ($errors->has('first_name') ? ' error' : ''), 'id' => 'first_name' ]) }}
  </div>
  <div class="form-group">
    {{ Form::label('last_name', 'Last Name') }}
    @if ($errors->has('last_name'))
      <div class="error-message">
        {{ $errors->first('last_name') }}
      </div>
    @endif
    {{ Form::text('last_name',Input::old('last_name'), [ 'class' => 'form-control' . ($errors->has('last_name') ? ' error' : ''), 'id' => 'last_name' ]) }}
  </div>
  <div class="form-group">
    {{ Form::label('organization', 'Organization') }}
    @if ($errors->has('organization'))
      <div class="error-message">
        {{ $errors->first('organization') }}
      </div>
    @endif
    {{ Form::text('organization',Input::old('organization'), [ 'class' => 'form-control' . ($errors->has('organization') ? ' error' : ''), 'id' => 'organization' ]) }}
  </div>
  <div class="form-group">
    {{ Form::label('phone', 'Phone') }}
    @if ($errors->has('phone'))
      <div class="error-message">
        {{ $errors->first('phone') }}
      </div>
    @endif
    {{ Form::text('phone',Input::old('phone'), [ 'class' => 'form-control' . ($errors->has('phone') ? ' error' : ''), 'id' => 'phone' ]) }}
  </div>
  <div class="form-group">
    {{ Form::label('email', 'Email') }}
    @if ($errors->has('email'))
      <div class="error-message">
        {{ $errors->first('email') }}
      </div>
    @endif
    {{ Form::text('email',Input::old('email'), [ 'class' => 'form-control' . ($errors->has('email') ? ' error' : ''), 'id' => 'email' ]) }}
  </div>
  <div class="form-group">
    {{ Form::label('password', 'Password') }}
    @if ($errors->has('password'))
      <div class="error-message">
        {{ $errors->first('password') }}
      </div>
    @endif
    {{ Form::password('password', [ 'class' => 'form-control' . ($errors->has('password') ? ' error' : ''), 'id' => 'password' ]) }}
  </div>
  <div class="form-group">
    {{ Form::label('password_confirmation', 'Password Confirmation') }}
    @if ($errors->has('password_confirmation'))
      <div class="error-message">
        {{ $errors->first('password_confirmation') }}
      </div>
    @endif
    {{ Form::password('password_confirmation', [ 'class' => 'form-control' . ($errors->has('password_confirmation') ? ' error' : ''), 'id' => 'password_confirmation' ]) }}
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

