<section class="formgroup highlight">

    <div class="formfield col-8">
        {{ Form::label('workorder_title', 'Workorder title:', ['class' => 'required']) }} <a href="#" class="help">&nbsp;</a>
        <div class="help-box">This is a user-friendly title that can be used to refer to this work order, e.g. &quot;Monthly Uber Monitoring&quot;. There is no need to include dates as these will be automatically stored alongside your work order submission. Please note that once submitted, the name cannot be changed.</div>

        @if(editing())
        {{ Form::text('workorder_title', $workorder->title, ['readonly' => 'readonly']) }}
        @else
        {{ Form::text('workorder_title', Input::old('workorder_title')) }}
        @endif

        {{ display_form_error('workorder_title', $errors) }}
    </div>

    <div class="formfield col-4 last">
            {{ Form::label('workorder_follows_on_from', 'This IWO follows on from (ref):', ['class' => 'required']) }} <a href="#" class="help">&nbsp;</a>
            <div class="help-box">If this work order follows on from, or superceeds, a previous work order, please enter the previous work order reference code here.</div>

            @if(editing())
            {{ Form::text('workorder_follows_on_from', $workorder->workorder_follows_on_from, ['readonly' => 'readonly']) }}
            @else
            {{ Form::text('workorder_follows_on_from', Input::old('workorder_follows_on_from')) }}
            @endif

            {{ display_form_error('workorder_follows_on_from', $errors) }}
            <span class="small-print white">Optional</span>
        </div>

</section>