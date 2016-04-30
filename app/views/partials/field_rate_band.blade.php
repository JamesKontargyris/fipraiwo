<div class="formfield">

    {{ Form::label('rate_band', 'Rate band:', ['class' => 'required']) }} <a href="#" class="help">&nbsp;</a>
    <div class="help-box">
        High cost countries: Switzerland, Norway, Denmark, Singapore, Japan, the UK, Australia, Ireland, Sweden, Belgium, France, Finland, South Korea, the Netherlands, Italy, Austria, Germany and Canada.
        <br><br>
        All other Units are standard cost countries.
    </div>
    <br>
    {{ Form::select('rate_band', ['' => 'Select one of the following...', 'high' => 'High Cost Country', 'standard' => 'Standard Cost Country'], (editing()) ? isset($workorder->workorder->rate_band) ? $workorder->workorder->rate_band : '' : Input::old('rate_band'), ['class' => 'inline rate-band-select']) }}
    {{ display_form_error('rate_band', $errors) }}

</div>