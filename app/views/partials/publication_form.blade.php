<div class="form-horizontal">

  <div class="form-group">
    {{ Form::label('', '&nbsp;', [ 'class' => 'col-md-1 control-label' ]) }}
    <div class="col-md-4">
      {{ Form::select('product_stage', array_merge(['' => 'Select a web publication...'], SelectHelper::get_publication_options()), null, [ 'class' => 'selectpicker' ] ) }} 
    </div>
    {{ Form::label('publication[0][name]', 'or enter name', [ 'class' => 'col-md-2 control-label' ]) }}
    <div class="col-md-5">
      {{ Form::text('publication[0][name]', Input::old('publication[0][name]'), [ 'class' => 'form-control' ]) }}
    </div>
  </div>
  <div class="form-group">
    {{ Form::label('publication[0][title]', 'Title', [ 'class' => 'col-md-1 control-label' ]) }}
    <div class="col-md-11">
      {{ Form::text('publication[0][title]', Input::old('publication[0][title]'), [ 'class' => 'form-control' ]) }}
    </div>
  </div>
  <div class="form-group">
    {{ Form::label('publication[0][url]', 'URL', [ 'class' => 'col-md-1 control-label' ]) }}
    <div class="col-md-11">
      {{ Form::text('publication[0][url]',Input::old('publication[0][url])'), [ 'class' => 'form-control' ]) }}
    </div>
  </div>
</div>
