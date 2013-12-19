<div class="form-horizontal award{{ $idx }}">
{{ Form::hidden("awards[$idx][id]", $award->id) }}
  <div class="form-group">
    <label class="control-label col-md-1">
    @if ($show_remove)
      <a href="#" class="icon remove-award" id="remove_award_{{$idx}}" title="Remove award"><span class="glyphicon glyphicon-remove"></span></a> 
    @else
      &nbsp;
    @endif
    </label>
    {{ Form::label("awards[$idx][title]", 'Title', [ 'class' => 'col-md-1 control-label' ]) }}
    <div class="col-md-10">
      {{ Form::text("awards[$idx][title]",$award->getFormValue(Input::old("awards[$idx][title]"),"title"), [ 'class' => 'form-control' ]) }}
    </div>
  </div>
  <div class="form-group">
    {{ Form::label("awards[$idx][url]", 'URL', [ 'class' => 'col-md-2 control-label' ]) }}
    <div class="col-md-10">
      {{ Form::text("awards[$idx][url]",$award->getFormValue(Input::old("awards[$idx][url]"),"url"), [ 'class' => 'form-control' ]) }}
    </div>
  </div>
</div>
