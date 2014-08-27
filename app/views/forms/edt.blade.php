@extends('layouts.master')

@section('nav_links')
	<li><a href="/" class="highlight"><i class="fa fa-caret-left fa-lg"></i> Back to IWO Menu</a></li>
    <li><a href="about/edt">About the EDT</a></li>
@stop

@section('content')
	<div class="intro">
		<p>If you have any general queries or would like to contact the EDT before submitting a work order request, please e-mail <a href="mailto:edt@fipra.com">edt@fipra.com</a>.</p>
	</div>

	@include('forms.partials.messages')

    @if(editing())
        {{ Form::open(['files' => true, 'url' => 'manage/confirmupdates']) }}
    @else
        {{ Form::open(['files' => true, 'url' => 'edt']) }}
    @endif

    @include('forms.partials.workorder_title_ref')

	<section class="col-6">
		<div class="formfield">
			{{ Form::label('commissioned_by', 'Work commissioned by:', ['class' => 'required']) }}
			@if(editing())
                {{ Form::text('commissioned_by', $workorder->workorder->commissioned_by, ['readonly' => 'readonly']) }}
            @else
                {{ Form::text('commissioned_by', Input::old('commissioned_by')) }}
            @endif
			{{ display_form_error('commissioned_by', $errors) }}
		</div>
		<div class="formfield">
			{{ Form::label('person_commissioning_work_is_account_director_responsible', 'Is the person commissioning the work the Account Director responsible?', ['class' => 'required']) }}
			{{ Form::select('person_commissioning_work_is_account_director_responsible', ['' => 'Please select...', 'No' => 'No', 'Yes' => 'Yes'], (editing()) ? $workorder->workorder->person_commissioning_work_is_account_director_responsible : Input::old('person_commissioning_work_is_account_director_responsible'), ['id' => 'person-commissioning-work-is-account-director-responsible']) }}
			{{ display_form_error('person_commissioning_work_is_account_director_responsible', $errors) }}
		</div>
		<div class="formfield sub-box" id="person-commissioning-work-is-account-director-responsible-reveal">
			{{ Form::label('account_director', 'Name the Account Director Responsible for this work:') }}
			{{ Form::text('account_director', (editing()) ? $workorder->workorder->account_director : Input::old('account_director')) }}
			{{ display_form_error('account_director', $errors) }}
		</div>
		<div class="formfield">
			{{ Form::label('lead_email_address', 'Email address:', ['class' => 'required']) }}
            @if(editing())
                {{ Form::email('lead_email_address', $workorder->workorder->lead_email_address, ['readonly' => 'readonly']) }}
            @else
                {{ Form::email('lead_email_address', Input::old('lead_email_address')) }}
            @endif
			{{ display_form_error('lead_email_address', $errors) }}
		</div>
		<div class="formfield">
			{{ Form::label('account_director', 'Account Director responsible:') }} <a href="#" class="help">&nbsp;</a>
			<div class="help-box">This should indicate the person in your Unit who is in charge of quality control and ultimately will approve the payment for the work.</div>
			{{ Form::text('account_director', (editing()) ? $workorder->workorder->account_director : Input::old('account_director')) }}
			{{ display_form_error('account_director', $errors) }}
		</div>
		<div class="formfield">
			{{ Form::label('project_and_client_company_name', 'Project and client company name:', ['class' => 'required']) }} <a href="#" class="help">&nbsp;</a>
			<div class="help-box">Please also denote if work is for internal or external use.</div>
			{{ Form::text('project_and_client_company_name', (editing()) ? $workorder->workorder->project_and_client_company_name : Input::old('project_and_client_company_name')) }}
			{{ display_form_error('project_and_client_company_name', $errors) }}
		</div>
		<div class="formfield">
			{{ Form::label('replicon_code', 'Replicon code (only applicable to Fipra International):') }} <a href="#" class="help">&nbsp;</a>
            <div class="help-box">Replicon codes are Fipra's internal timesheet codes.</div>
			{{ Form::text('replicon_code', (editing()) ? $workorder->workorder->replicon_code : Input::old('replicon_code')) }}
			{{ display_form_error('replicon_code', $errors) }}
		</div>
		<div class="formfield">
			{{ Form::label('required_completion_date', 'Required completion date:', ['class' => 'required']) }} <a href="#" class="help">&nbsp;</a>
			<div class="help-box">If you would like the EDT to factor in a second modification round after the initial draft, we'll be pleased to include this as part of our project planning. Subject to time, we can plan further modification rounds as the project progresses. Please indicate time constraints as early as possible so we can effectively plan to meet your deadlines.</div>
			{{ Form::text('required_completion_date', (editing()) ? $workorder->workorder->required_completion_date : Input::old('required_completion_date'), ['class' => 'datepicker']) }}
			{{ display_form_error('required_completion_date', $errors) }}
		</div>
		<div class="formfield">
			{{ Form::label('type_of_product', 'Type of document / product to be edited, design and/or translated:', ['class' => 'required']) }}
			{{ Form::text('type_of_product', (editing()) ? $workorder->workorder->type_of_product : Input::old('type_of_product')) }}
			{{ display_form_error('type_of_product', $errors) }}
		</div>
	</section>

	<section class="col-6 last">
		<div class="formfield">
			{{ Form::label('services_required', 'Service(s) required:', ['class' => 'required']) }} 
			<div>{{ Form::checkbox('proofreading', (editing()) ? $workorder->workorder->proofreading : Input::old('proofreading')) }} Proofreading <a href="#" class="help">&nbsp;</a>
                <div class="help-box">Reading the text for consistency in usage and layout, for accuracy in the text and references, and for typesetting errors. Proofreading is a last quality check to ensure consistency and adherence to the Fipra editorial style guidelines.</div>
            </div>
			<div>{{ Form::checkbox('copy_editing', (editing()) ? $workorder->workorder->copy_editing : Input::old('copy_editing')) }} Copy Editing <a href="#" class="help">&nbsp;</a>
                <div class="help-box">Making sure that raw text, or copy, is correct in terms of spelling and grammar and is easy to read; preventing embarrassing errors of fact; correcting errors in spelling, grammar, punctuation, style and usage; checking suitability of language and that abbreviations/ acronyms have been explained; and checking that text is not missing or redundant.</div>
            </div>
			<div>{{ Form::checkbox('rewriting', (editing()) ? $workorder->workorder->rewriting : Input::old('rewriting')) }} Re-writing <a href="#" class="help">&nbsp;</a>
                <div class="help-box">Revising and restructuring text in depth (often known as substantive editing), making comments on content and style, and suggesting new text or areas for further consideration; this service can also include the reworking, shortening or summarising of any kind of text.</div>
            </div>
			<div>{{ Form::checkbox('quickedit', (editing()) ? $workorder->workorder->quickedit : Input::old('quickedit')) }} Quick-Edit <a href="#" class="help">&nbsp;</a>
                <div class="help-box">New service offering quick spelling and grammar check and ensuring adherence to Fipra's editorial guidelines.</div>
            </div>
			<div>{{ Form::checkbox('graphic_or_print_design', (editing()) ? $workorder->workorder->graphic_or_print_design : Input::old('graphic_or_print_design')) }} Graphic/Print Design <a href="#" class="help">&nbsp;</a>
                <div class="help-box">Formatting and layout to an existing house/client brand style or a totally new design across a wide range of products.</div>
            </div>
			<div>{{ Form::checkbox('web_design', (editing()) ? $workorder->workorder->web_design : Input::old('web_design')) }} Web Design <a href="#" class="help">&nbsp;</a>
                <div class="help-box">Set up a website or web app – we can help with design, hosting, domain name registration, SEO etc.</div>
            </div>
			<div>{{ Form::checkbox('translation', (editing()) ? $workorder->workorder->translation : Input::old('translation')) }} Translation <a href="#" class="help">&nbsp;</a>
                <div class="help-box">Our translators can translate documents, presentations, proposals and any other materials you require into their own native language.</div></div>
		</div>
		<div class="formfield">
			{{ Form::label('instructions', 'Any other instructions:') }} <a href="#" class="help">&nbsp;</a>
			<div class="help-box">Please indicate special instructions, explanatory information, guidance on tone, target audience, objectives etc.</div>
			{{ Form::textarea('instructions', (editing()) ? $workorder->workorder->instructions : Input::old('instructions'), ['rows' => '10']) }}
			{{ display_form_error('instructions', $errors) }}
		</div>
		<div class="formfield">
			{{ Form::label('require_cost_estimate', 'Do you require a cost estimate before work commences?', ['class' => 'required']) }}
			{{ Form::select('require_cost_estimate', ['' => 'Please select...', 'No' => 'No', 'Yes' => 'Yes'], (editing()) ? $workorder->workorder->require_cost_estimate : Input::old('require_cost_estimate')) }}
			{{ display_form_error('require_cost_estimate', $errors) }}
		</div>
        @if( ! editing())
            <div class="file-field">
                <div class="formfield">
                    @include('forms.partials.file_upload')
                </div>
            </div>
        @endif
	</section>

	@include('forms.partials.copy_emails')

	<section class="col-12" style="clear:both">
		
		{{ display_submit_button('Next') }}
		@include('forms.partials.loading')

		<p class="small-print">
			Please note: although every effort is made to accommodate tight deadlines and time constraints, The EDT must ensure the quality of work produced is that expected of Fipra. If a time frame and/or deadline is unrealistic the EDT will discuss with you the best course of action to complete your request as fully as possible. In the unlikely event a project time frame and/or deadline is impossible to meet, the EDT will inform you when you submit your work order request.
		</p>

		<div class="grey-box">
			<div class="col-10 last">
	            <h4><a name="confirmation"></a>Confirmation</h4>
	            <p>The EDT will confirm receipt of the request and deadline by return e-mail at its earliest convenience. An editor and/or graphic designer will then be assigned to the project and work will commence.</p>
	            
	            <h4><a name="completion"></a>Completion</h4>
	            <p>When you receive an acceptable final version of your document / presentation, please send an e-mail to us to acknowledge receipt of the final document. It would also be extremely useful if you included feedback on the project and your experiences of the EDT – this feedback is vital to us going forward, so we can better tailor our services and products to your requirements.</p>
	            
	            <h4><a name="costs"></a>Costs</h4>
	            <p>The EDT  charges €56.25 per hour/pro rata based on time used or €450 per day. Cost estimates can be given in advance of agreeing work.</p>
	            <p class="italic">Please Note: A surcharge of 20% will be applied to all requests that require a deadline of within 24 hours of the work commencing.</p>

	            <h4><a name="invoicing"></a>Invoicing</h4>
	            <p>The EDT will invoice monthly to Fipra International who will onward bill to Units and Members. Thus the EDT effectively operates as a “Special Adviser” would within the Network.</p>

	            <h4><a name="working_hours"></a>Working Hours</h4>
	            <p>The EDT is currently made up of Editors and Graphic Designers based all over Europe, who work to the following office hours: Monday-Friday 09.00-18.00 (CET).</p>
	            <p>This window allows us to cater for regular and urgent editorial and/or design work in most timezones. In some cases we can be flexible on these hours to accommodate your timings and deadlines – please contact us to discuss your time frame if your project is time-sensitive.</p>
	            <p>We regularly monitor and review the level of work from different timezones and territories to ensure suitable resources and services are available and maintained. Please submit your project request at your earliest opportunity to ensure we can plan accordingly and allocate the most suited team members to your project specification.</p>
            </div>
        </div>

        <p><a href="#top" class="back-to-top">back to top</a></p>
	</section>

	{{ Form::close() }}

	<script type="text/javascript" src="{{ asset('js/edtWorkOrder.js') }}"></script>
@stop