{{ Form::label('rate_type', 'Rate type:', ['class' => 'required']) }}<br>
{{ Form::select('rate_type', ['' => 'Select one of the following...', 'Fipra day rate' => 'Fipra day rate', 'Monthly rate' => 'Monthly rate', 'Flat or project rate' => 'Flat or project rate'], (editing()) ? isset($workorder->workorder->rate_type) ? $workorder->workorder->rate_type : '' : Input::old('rate_type'), ['class' => 'inline', 'id' => 'rate-type']) }}
{{ display_form_error('rate_type', $errors) }}

@if(Request::segment(1) == 'unit' || Request::segment(2) == 'unit')
    @include('partials.fipraratestable')
@endif