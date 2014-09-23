{{ Form::hidden("keypersons[$idx][id]", $keyperson->id) }}

<div class='form-group {{ $errors->has("keypersons.$idx.first_name") ? "has-error" : "" }} '>
    {{ Form::label("keypersons[$idx][first_name]", "First Name", [ "class" => "col-md-3 control-label" ]) }}
    <div class="col-md-7">
      {{ Form::text("keypersons[$idx][first_name]",$keyperson->getFormValue(Input::old("keypersons[$idx][first_name]"),"first_name"), [ "class" => "form-control" ]) }}
    </div>
</div>
<div class='form-group {{ $errors->has("keypersons.$idx.last_name") ? "has-error" : "" }} '>
    {{ Form::label("keypersons[$idx][last_name]", "Last Name", [ "class" => "col-md-3 control-label" ]) }}
    <div class="col-md-7">
      {{ Form::text("keypersons[$idx][last_name]",$keyperson->getFormValue(Input::old("keypersons[$idx][last_name]"),"last_name"), [ "class" => "form-control" ]) }}
    </div>
</div>
              <div class="form-group">
                {{ Form::label("keypersons[$idx][title]", "Title", [ "class" => "col-md-3 control-label" ]) }}
                  <div class="col-md-7">
                    {{ Form::text("keypersons[$idx][title]",$keyperson->getFormValue(Input::old("keypersons[$idx][title]"),"title"), [ "class" => "form-control" ]) }}
                  </div>
                </div>
<div class='form-group {{ $errors->has("keypersons.$idx.email") ? "has-error" : "" }} '>
  {{ Form::label("keypersons[$idx][email]", "Email", [ "class" => "col-md-3 control-label" ]) }}
                  <div class="col-md-7">
    {{ Form::text("keypersons[$idx][email]",$keyperson->getFormValue(Input::old("keypersons[$idx][email]"),"email"), [ "class" => "form-control" ]) }}
                  </div>
                </div>
                <div class="form-group">
  {{ Form::label("keypersons[$idx][phone]", "Phone", [ "class" => "col-md-3 control-label" ]) }}
                  <div class="col-md-7">
    {{ Form::text("keypersons[$idx][phone]",$keyperson->getFormValue(Input::old("keypersons[$idx][phone]"),"phone"), [ "class" => "form-control" ]) }}
                  </div>
                </div>

      <div class="form-group">
  {{ Form::label("keypersons[$idx][address]", "Street Address", [ "class" => "col-md-3 control-label" ]) }}
        <div class="col-md-7">
    {{ Form::text("keypersons[$idx][address]",$keyperson->getFormValue(Input::old("keypersons[$idx][address]"),"address"), [ "class" => "form-control" ]) }}
        </div>
      </div>
      <div class="form-group">
  {{ Form::label("keypersons[$idx][address_line2]", "Address Line&nbsp;2", [ "class" => "col-md-3 control-label" ]) }}
      <div class="col-md-7">
    {{ Form::text("keypersons[$idx][address_line2]",$keyperson->getFormValue(Input::old("keypersons[$idx][address_line2]"),"address_line2"), [ "class" => "form-control" ]) }}
      </div>
      </div>
      <div class="form-group">
  {{ Form::label("keypersons[$idx][address_line3]", "Address Line&nbsp;3", [ "class" => "col-md-3 control-label" ]) }}
        <div class="col-md-7">
    {{ Form::text("keypersons[$idx][address_line3]",$keyperson->getFormValue(Input::old("keypersons[$idx][address_line3]"),"address_line3"), [ "class" => "form-control" ]) }}
        </div>
      </div>
          
                <div class="form-group">
  {{ Form::label("keypersons[$idx][city]", "City", [ "class" => "col-md-3 control-label" ]) }}
                <div class="col-md-3">
    {{ Form::text("keypersons[$idx][city]",$keyperson->getFormValue(Input::old("keypersons[$idx][city]"),"city"), [ "class" => "form-control" ]) }}
                </div>
                {{ Form::label("keypersons[$idx][state]", "State / Province", [ "class" => "col-md-1 control-label" ]) }}
                <div class="col-md-3">
    {{ Form::text("keypersons[$idx][state]",$keyperson->getFormValue(Input::old("keypersons[$idx][state]"),"state"), [ "class" => "form-control" ]) }}
                </div>
                </div>
                <div class="form-group">
  {{ Form::label("keypersons[$idx][zip_code]", "Zip&nbsp;Code / Postal&nbsp;Code", [ "class" => "col-md-3 control-label" ]) }}
                
                  <div class="col-md-3">
    {{ Form::text("keypersons[$idx][zip_code]",$keyperson->getFormValue(Input::old("keypersons[$idx][zip_code]"),"zip_code"), [ "class" => "form-control" ]) }}
                  </div>
  {{ Form::label("keypersons[$idx][country]", "Country", [ "class" => "col-md-1 control-label" ]) }}
                  <div class="col-md-3">
    {{ Form::select("keypersons[$idx][country]", Config::get("countries.countries"), $keyperson->getFormValue(Input::old("keypersons[$idx][country]"),"country"), [ "class" => "country-multiselect form-control" ] ) }} 
                  </div> 
                </div>

        @if (!empty($keyperson->photo_file_name))
          <label class="col-md-3 control-label">Photo</label>
          <div class="col-md-9">
            <img class="keyperson-logo" src="{{ asset($keyperson->photo->url('small')) }}" />
          </div>
        @endif
              <div class="form-group">
    {{ Form::label("keypersons_photos[]", "Upload&nbsp;photo (5&nbsp;MB&nbsp;max)", [ "class" => "col-md-3 control-label" ]) }}
                
                <div class="col-md-7">
                  {{ Form::file("keypersons_photos[]",[ "class" => "form-control" ]) }}
                </div>
              </div>

@if (false)
{{ Form::hidden("keypersons[$idx][id]", $keyperson->id) }}
<div class='form-group {{ $errors->has("keypersons.$idx.first_name") ? "has-error" : "" }} '>
  {{ Form::label("keypersons[$idx][first_name]", "First Name", [ "class" => "col-md-3 control-label" ]) }}
  <div class="col-md-9">
    {{ Form::text("keypersons[$idx][first_name]",$keyperson->getFormValue(Input::old("keypersons[$idx][first_name]"),"first_name"), [ "class" => "form-control" ]) }}
  </div>
</div>
<div class='form-group {{ $errors->has("keypersons.$idx.last_name") ? "has-error" : "" }} '>
  {{ Form::label("keypersons[$idx][last_name]", "Last Name", [ "class" => "col-md-3 control-label" ]) }}
  <div class="col-md-9">
    {{ Form::text("keypersons[$idx][last_name]",$keyperson->getFormValue(Input::old("keypersons[$idx][last_name]"),"last_name"), [ "class" => "form-control" ]) }}
  </div>
</div>
<div class="form-group">
  {{ Form::label("keypersons[$idx][title]", "Title", [ "class" => "col-md-3 control-label" ]) }}
  <div class="col-md-9">
    {{ Form::text("keypersons[$idx][title]",$keyperson->getFormValue(Input::old("keypersons[$idx][title]"),"title"), [ "class" => "form-control" ]) }}
  </div>
</div>
<div class='form-group {{ $errors->has("keypersons.$idx.email") ? "has-error" : "" }} '>
  {{ Form::label("keypersons[$idx][email]", "Email", [ "class" => "col-md-3 control-label" ]) }}
  <div class="col-md-9">
    {{ Form::text("keypersons[$idx][email]",$keyperson->getFormValue(Input::old("keypersons[$idx][email]"),"email"), [ "class" => "form-control" ]) }}
  </div>
</div>
<div class="form-group">
  {{ Form::label("keypersons[$idx][phone]", "Phone", [ "class" => "col-md-3 control-label" ]) }}
  <div class="col-md-9">
    {{ Form::text("keypersons[$idx][phone]",$keyperson->getFormValue(Input::old("keypersons[$idx][phone]"),"phone"), [ "class" => "form-control" ]) }}
  </div>
</div>
<div class="form-group">
  {{ Form::label("keypersons[$idx][address]", "Street Address", [ "class" => "col-md-3 control-label" ]) }}
  <div class="col-md-9">
    {{ Form::text("keypersons[$idx][address]",$keyperson->getFormValue(Input::old("keypersons[$idx][address]"),"address"), [ "class" => "form-control" ]) }}
  </div>
</div>
<div class="form-group">
  {{ Form::label("keypersons[$idx][address_line2]", "Address Line&nbsp;2", [ "class" => "col-md-3 control-label" ]) }}
  <div class="col-md-9">
    {{ Form::text("keypersons[$idx][address_line2]",$keyperson->getFormValue(Input::old("keypersons[$idx][address_line2]"),"address_line2"), [ "class" => "form-control" ]) }}
  </div>
</div>
<div class="form-group">
  {{ Form::label("keypersons[$idx][address_line3]", "Address Line&nbsp;3", [ "class" => "col-md-3 control-label" ]) }}
  <div class="col-md-9">
    {{ Form::text("keypersons[$idx][address_line3]",$keyperson->getFormValue(Input::old("keypersons[$idx][address_line3]"),"address_line3"), [ "class" => "form-control" ]) }}
  </div>
</div>
<div class="form-group">
  {{ Form::label("keypersons[$idx][city]", "City", [ "class" => "col-md-3 control-label" ]) }}
  <div class="col-md-3">
    {{ Form::text("keypersons[$idx][city]",$keyperson->getFormValue(Input::old("keypersons[$idx][city]"),"city"), [ "class" => "form-control" ]) }}
  </div>
  {{ Form::label("keypersons[$idx][state]", "State / Province", [ "class" => "col-md-3 control-label" ]) }}
  <div class="col-md-3">
    {{ Form::text("keypersons[$idx][state]",$keyperson->getFormValue(Input::old("keypersons[$idx][state]"),"state"), [ "class" => "form-control" ]) }}
  </div>
</div>
<div class="form-group">
  {{ Form::label("keypersons[$idx][zip_code]", "Zip&nbsp;Code / Postal&nbsp;Code", [ "class" => "col-md-3 control-label" ]) }}
  <div class="col-md-3">
    {{ Form::text("keypersons[$idx][zip_code]",$keyperson->getFormValue(Input::old("keypersons[$idx][zip_code]"),"zip_code"), [ "class" => "form-control" ]) }}
  </div>
  {{ Form::label("keypersons[$idx][country]", "Country", [ "class" => "col-md-3 control-label" ]) }}
  <div class="col-md-3">
    {{ Form::select("keypersons[$idx][country]", Config::get("countries.countries"), $keyperson->getFormValue(Input::old("keypersons[$idx][country]"),"country"), [ "class" => "country-multiselect form-control" ] ) }} 
  </div>
</div>
<div class="form-group">
  @if (empty($keyperson->photo_file_name))
  {{ Form::label("keypersons_photos[]", "Upload&nbsp;photo (5&nbsp;MB&nbsp;max)", [ "class" => "col-md-3 control-label" ]) }}
  <div class="col-md-9">
    {{ Form::file("keypersons_photos[]",[ "class" => "form-control" ]) }}
  </div>
  @else
  <label class="col-md-3 control-label">Photo</label>
  <div class="col-md-9">
    <img class="keyperson-logo" src="{{ asset($keyperson->photo->url('small')) }}" />
  </div>
  <div>
    {{ Form::label("keypersons_photos[]", "Upload&nbsp;new&nbsp;photo (5&nbsp;MB&nbsp;max)", [ "class" => "col-md-3 control-label" ]) }}
    <div class="col-md-9">
      {{ Form::file("keypersons_photos[]",[ "class" => "form-control" ]) }}
    </div>
  </div>
  @endif
</div>
@endif
