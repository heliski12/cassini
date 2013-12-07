<div class="form-group">
  {{ Form::label('keyperson[0][first_name]', 'First Name', [ 'class' => 'col-md-3 control-label' ]) }}
  <div class="col-md-9">
    {{ Form::text('keyperson[0][first_name]',Input::old('first_name'), [ 'class' => 'form-control', 'id' => 'first_name' ]) }}
  </div>
</div>
<div class="form-group">
  {{ Form::label('keyperson[0][last_name]', 'Last Name', [ 'class' => 'col-md-3 control-label' ]) }}
  <div class="col-md-9">
    {{ Form::text('keyperson[0][last_name]',Input::old('last_name'), [ 'class' => 'form-control', 'id' => 'last_name' ]) }}
  </div>
</div>
<div class="form-group">
  {{ Form::label('keyperson[0][title]', 'Title', [ 'class' => 'col-md-3 control-label' ]) }}
  <div class="col-md-9">
    {{ Form::text('keyperson[0][title]',Input::old('title'), [ 'class' => 'form-control', 'id' => 'title' ]) }}
  </div>
</div>
<div class="form-group">
  {{ Form::label('keyperson[0][email]', 'Email', [ 'class' => 'col-md-3 control-label' ]) }}
  <div class="col-md-9">
    {{ Form::text('keyperson[0][email]',Input::old('email'), [ 'class' => 'form-control', 'id' => 'email' ]) }}
  </div>
</div>
<div class="form-group">
  {{ Form::label('keyperson[0][phone]', 'Phone', [ 'class' => 'col-md-3 control-label' ]) }}
  <div class="col-md-9">
    {{ Form::text('keyperson[0][phone]',Input::old('phone'), [ 'class' => 'form-control', 'id' => 'phone' ]) }}
  </div>
</div>
<div class="form-group">
  {{ Form::label('keyperson[0][address]', 'Street Address', [ 'class' => 'col-md-3 control-label' ]) }}
  <div class="col-md-9">
    {{ Form::text('keyperson[0][address]',Input::old('address'), [ 'class' => 'form-control', 'id' => 'address' ]) }}
  </div>
</div>
<div class="form-group">
  {{ Form::label('keyperson[0][address_line2]', 'Address Line&nbsp;2', [ 'class' => 'col-md-3 control-label' ]) }}
  <div class="col-md-9">
    {{ Form::text('keyperson[0][address_line2]',Input::old('address_line2'), [ 'class' => 'form-control', 'id' => 'address_line2' ]) }}
  </div>
</div>
<div class="form-group">
  {{ Form::label('keyperson[0][address_line3]', 'Address Line&nbsp;3', [ 'class' => 'col-md-3 control-label' ]) }}
  <div class="col-md-9">
    {{ Form::text('keyperson[0][address_line3]',Input::old('address_line3'), [ 'class' => 'form-control', 'id' => 'address_line3' ]) }}
  </div>
</div>
<div class="form-group">
  {{ Form::label('keyperson[0][city]', 'City', [ 'class' => 'col-md-3 control-label' ]) }}
  <div class="col-md-3">
    {{ Form::text('keyperson[0][city]',Input::old('city'), [ 'class' => 'form-control', 'id' => 'city' ]) }}
  </div>
  {{ Form::label('keyperson[0][state]', 'State / Province', [ 'class' => 'col-md-3 control-label' ]) }}
  <div class="col-md-3">
    {{ Form::text('keyperson[0][state]',Input::old('state'), [ 'class' => 'form-control', 'id' => 'state' ]) }}
  </div>
</div>
<div class="form-group">
  {{ Form::label('keyperson[0][zip_code]', 'Zip&nbsp;Code / Postal&nbsp;Code', [ 'class' => 'col-md-3 control-label' ]) }}
  <div class="col-md-3">
    {{ Form::text('keyperson[0][zip_code]',Input::old('zip_code'), [ 'class' => 'form-control', 'id' => 'zip_code' ]) }}
  </div>
  {{ Form::label('keyperson[0][country]', 'Country', [ 'class' => 'col-md-3 control-label' ]) }}
  <div class="col-md-3">
    {{ Form::select('keyperson[0][country]', Config::get('countries.countries'), null, [ 'class' => 'country-multiselect form-control' ] ) }} 
  </div>
</div>
<div class="form-group">
  {{ Form::label('keyperson[0][photo]', 'Upload&nbsp;photo (5&nbsp;MB&nbsp;max)', [ 'class' => 'col-md-3 control-label' ]) }}
  <div class="col-md-9">
    {{ Form::file('keyperson[0][photo]',[ 'class' => 'form-control', 'id' => 'photo' ]) }}
  </div>
</div>
