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
        {{ Form::label('workorder_reference', 'Workorder reference:') }} <a href="#" class="help">&nbsp;</a>
        <div class="help-box">If you wish, you may enter a workorder reference number / code of at least 10 characters in length. This is optional; if you choose not to enter a reference, we will generate one automatically for you. This reference will be used to view and manage this work order via our online system in the future.</div>
        @if(editing())
        {{ Form::text('workorder_reference', $workorder->iwo_ref, ['disabled' => 'disabled']) }}
        @else
        {{ Form::text('workorder_reference', Input::old('workorder_reference')) }}
        @endif
        {{ display_form_error('workorder_reference', $errors) }}
    </div>

</section>