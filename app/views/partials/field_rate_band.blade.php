<div class="formfield">

{{--    {{ Form::select('rate_band', ['' => 'Select one of the following...', 'high' => 'High Cost Country', 'standard' => 'Standard Cost Country'], (editing()) ? isset($workorder->workorder->rate_band) ? $workorder->workorder->rate_band : '' : Input::old('rate_band'), ['class' => 'inline rate-band-select']) }}--}}
    {{ Form::hidden('rate_band', (editing()) ? isset($workorder->workorder->rate_band) ? $workorder->workorder->rate_band : '' : Input::old('rate_band'), ['class' => 'rate-band-select']) }}
</div>