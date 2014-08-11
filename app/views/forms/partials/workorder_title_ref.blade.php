<section class="formgroup highlight">

    <div class="formfield">
        {{ Form::label('workorder_title', 'Workorder title:', ['class' => 'required']) }} <a href="#" class="help">&nbsp;</a>
        <div class="help-box">This is a user-friendly title that can be used to refer to this work order, e.g. &quot;Monthly Uber Monitoring&quot;. There is no need to include dates as these will be automatically stored alongside your work order submission. Please note that once submitted, the name cannot be changed.</div>

        @if(editing())
        {{ Form::text('workorder_title', $workorder->title, ['readonly' => 'readonly']) }}
        @else
        {{ Form::text('workorder_title', Input::old('workorder_title')) }}
        @endif

        {{ display_form_error('workorder_title', $errors) }}
    </div>

</section>