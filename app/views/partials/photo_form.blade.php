<div class="form-horizontal">
  <div class="form-group">
    {{ Form::label('photo[0][photo_file]', 'Photo 1', [ 'class' => 'col-md-3 control-label' ]) }}
    <div class="col-md-9">
      {{ Form::file('photo[0][file]',[ 'class' => 'form-control' ]) }}
    </div>
  </div>
  <div class="form-group">
    {{ Form::label('photo[0][description]', 'Description', [ 'class' => 'col-md-3 control-label' ]) }}
    <div class="col-md-9">
      {{ Form::text('photo[0][description]',Input::old('photo[0][description])'), [ 'class' => 'form-control' ]) }}
    </div>
  </div>
</div>
