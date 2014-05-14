@extends('layouts.master')

@section('nav_links')
	<li><a href="/" class="highlight"><i class="fa fa-caret-left fa-lg"></i> Back to IWO Menu</a></li>
	<li><a href="#">Item 1</a></li>
	<li><a href="#">Item 2</a></li>
	<li><a href="#">Item 3</a></li>
	<li><a href="#">Item 4</a></li>
@stop

@section('content')
	<div class="intro">
		<p>If you have any general queries or would like to contact the EDT before submitting a work order request, please e-mail <a href="mailto:edt@fipra.com">edt@fipra.com</a>.</p>
	</div>
	<div>
		<p><span class="red">*</span> = required <span class="showjs">| Click <span class="help">&nbsp;</span> for help</span></p>
	</div>
	
	@include('forms.partials.messages')

	{{ Form::open(['files' => true, 'url' => 'edt']) }}
	<section class="col-6">
		<div class="formfield">
			{{ Form::label('commissioned_by', 'Work commissioned by:', ['class' => 'required']) }}
			{{ Form::text('commissioned_by', Input::old('commissioned_by')) }}
			{{ display_form_error('commissioned_by', $errors) }}
		</div>
		<div class="formfield">
			{{ Form::label('unit_special_adviser_or_correspondent', 'Name of Unit / Special Adviser / Correspondent:', ['class' => 'required']) }}
			{{ Form::text('unit_special_adviser_or_correspondent', Input::old('unit_special_adviser_or_correspondent')) }}
			{{ display_form_error('unit_special_adviser_or_correspondent', $errors) }}
		</div>
		<div class="formfield">
			{{ Form::label('contact_email_address', 'Contact email address:', ['class' => 'required']) }}
			{{ Form::email('contact_email_address', Input::old('contact_email_address')) }}
			{{ display_form_error('contact_email_address', $errors) }}
		</div>
		<div class="formfield">
			{{ Form::label('account_director', 'Account Director responsible (only applicable to Fipra International):') }} <a href="#" class="help">&nbsp;</a>
			<div class="help-box">This should indicate the person in your Unit who is in charge of quality control and ultimately will approve the cost of the work.</div>
			{{ Form::text('account_director', Input::old('account_director')) }}
			{{ display_form_error('account_director', $errors) }}
		</div>
		<div class="formfield">
			{{ Form::label('project_and_client_name', 'Project and client name:', ['class' => 'required']) }} <a href="#" class="help">&nbsp;</a>
			<div class="help-box">Please also denote if work is for internal or external use.</div>
			{{ Form::text('project_and_client_name', Input::old('project_and_client_name')) }}
			{{ display_form_error('project_and_client_name', $errors) }}
		</div>
		<div class="formfield">
			{{ Form::label('replicon_code', 'Replicon code (only applicable to Fipra International):') }}
			{{ Form::text('replicon_code', Input::old('replicon_code')) }}
			{{ display_form_error('replicon_code', $errors) }}
		</div>
		<div class="formfield">
			{{ Form::label('required_completion_date_and_time', 'Required completion date and time:', ['class' => 'required']) }} <a href="#" class="help">&nbsp;</a>
			<div class="help-box">If you would like the EDT to factor in a second modification round after the initial draft, we'll be pleased to include this as part of our project planning. Subject to time, we can plan further modification rounds as the project progresses. Please indicate time constraints as early as possible so we can effectively plan to meet your deadlines.</div>
			{{ Form::text('required_completion_date_and_time', Input::old('required_completion_date_and_time')) }}
			{{ display_form_error('required_completion_date_and_time', $errors) }}
		</div>
		<div class="formfield">
			{{ Form::label('type_of_product', 'Type of document / product:', ['class' => 'required']) }} 
			{{ Form::text('type_of_product', Input::old('type_of_product')) }}
			{{ display_form_error('type_of_product', $errors) }}
		</div>
	</section>

	<section class="col-6 last">
		<div class="formfield">
			{{ Form::label('services_required', 'Service(s) required:', ['class' => 'required']) }} 
			<div>{{ Form::checkbox('editing', Input::old('editing')) }} English Language Editing</div>
			<div>{{ Form::checkbox('design', Input::old('design')) }} Graphic/Web Design</div>
			<div>{{ Form::checkbox('translation', Input::old('translation')) }} Translation</div>
			{{ display_form_error('editing', $errors) }}
			{{ display_form_error('design', $errors) }}
			{{ display_form_error('translation', $errors) }}
		</div>
		<div class="formfield">
			{{ Form::label('instructions', 'Any other instructions:') }} <a href="#" class="help">&nbsp;</a>
			<div class="help-box">Please indicate special instructions, explanatory information, guidance on tone, target audience, objectives etc.</div>
			{{ Form::textarea('instructions', Input::old('instructions'), ['rows' => '10']) }} 
			{{ display_form_error('instructions', $errors) }}
		</div>
		<div class="formfield">
			{{ Form::label('require_consultation', 'Do you require a consultation with a member of our team?', ['class' => 'required']) }} <a href="#" class="help">&nbsp;</a>
			<div class="help-box">We'll be happy to talk through any part of your project with you, whether you want to discuss printing options, explore how best to achieve your aims, relay ideas or if you're just looking for some inspiration. Some projects, such as web design and brand/logo design, would benefit from an initial consulation to ensure your practical/visual requirements, and those of your audience, will be met successfully.</div>
			{{ Form::select('require_consultation', ['' => 'Please select...', 'No' => 'No', 'Yes' => 'Yes'], Input::old('require_consultation')) }}
			{{ display_form_error('require_consultation', $errors) }}
		</div>
		<div class="formfield">
			{{ Form::label('require_cost_estimate', 'Do you require a cost estimate?', ['class' => 'required']) }}
			{{ Form::select('require_cost_estimate', ['' => 'Please select...', 'No' => 'No', 'Yes' => 'Yes'], Input::old('require_cost_estimate')) }}
			{{ display_form_error('require_cost_estimate', $errors) }}
		</div>
		<div class="file-field">
			<div class="formfield">
				@include('forms.partials.file_upload')
			</div>
		</div>
	</section>

	<section class="col-12">
		
		@include('forms.partials.registered_email')
		
		{{ display_submit_button('Next') }}

		<p class="small-print">
			Please note: although every effort is made to accommodate tight deadlines and time constraints, The EDT must ensure the quality of work produced is that expected of Fipra. If a time frame and/or deadline is unrealistic the EDT will discuss with you the best course of action to complete your request as fully as possible. In the unlikely event a project time frame and/or deadline is impossible to meet, the EDT will inform you when you submit your work order request.
		</p>

		<div class="grey-box">
			<div class="col-6">
	            <h2><a name="confirmation"></a>Confirmation</h2>
	            <p>The EDT will confirm receipt of the request and deadline by return e-mail at its earliest convenience. An editor and/or graphic designer will then be assigned to the project and work will commence.</p>
	            
	            <h2><a name="completion"></a>Completion</h2>
	            <p>When you receive an acceptable final version of your document / presentation, please send an e-mail to us to acknowledge receipt of the final document. It would also be extremely useful if you included feedback on the project and your experiences of the EDT – this feedback is vital to us going forward, so we can better tailor our services and products to your requirements.</p>
	            
	            <h2><a name="costs"></a>Costs</h2>
	            <p>The EDT  charges €56.25 per hour/pro rata based on time used or €450 per day. Cost estimates can be given in advance of agreeing work.</p>
	            <p class="italic">Please Note: A surcharge of 20% will be applied to all requests that require a deadline of within 24 hours of the work commencing.</p>
			</div>
            <div class="col-6 last">
	            
	            <h2><a name="invoicing"></a>Invoicing</h2>
	            <p>The EDT will invoice monthly to Fipra International who will onward bill to Units and Members. Thus the EDT effectively operates as a “Special Adviser” would within the Network.</p>

	            <h2><a name="working_hours"></a>Working Hours</h2>
	            <p>The EDT is currently made up of Editors and Graphic Designers based all over Europe, who work to the following office hours: Monday-Friday 09.00-18.00 (CET).</p>
	            <p>This window allows us to cater for regular and urgent editorial and/or design work in most timezones. In some cases we can be flexible on these hours to accommodate your timings and deadlines – please contact us to discuss your time frame if your project is time-sensitive.</p>
	            <p>We regularly monitor and review the level of work from different timezones and territories to ensure suitable resources and services are available and maintained. Please submit your project request at your earliest opportunity to ensure we can plan accordingly and allocate the most suited team members to your project specification.</p>
            </div>
        </div>

        <p><a href="#top" class="back-to-top">back to top</a></p>
	</section>

	{{ Form::close() }}
@stop