<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
  <h4 class="modal-title" id="password_reminder_label">Forgot password?</h4>
</div>
{{ Form::open( [ 'url' => action('RemindersController@postRemind'), 'role' => 'form', 'id' => 'password_reminder_form' ] ) }}
  <div class="modal-body forgot">
    Enter the email address you registered with and we’ll send instructions on how to reset your password.
      <div class="form-group {{ (!empty($error) ? 'has-error' : '') }} {{ (!empty($status) ? 'has-success' : '') }}">
        @if (!empty($status))
          <label class="control-label" for="email">{{ $status }}</label>
        @elseif (!empty($error))
          <label class="control-label" for="email">{{ $error }}</label>
        @endif
        {{ Form::email('email', null, [ 'class' => 'form-control', 'placeholder' => 'Registered email address' ]) }}
      </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">CLOSE</button>
    {{ Form::button('Send Instructions', [ 'class' => 'btn btn-primary', 'type' => 'submit' ] ) }}
  </div>
{{ Form::close() }}

