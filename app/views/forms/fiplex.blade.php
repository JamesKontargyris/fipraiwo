@extends('layouts.master')

@section('nav_links')
	<li><a href="/" class="highlight"><i class="fa fa-caret-left fa-lg"></i> Back to IWO Menu</a></li>
	<li><a href="about/fiplex">About Fiplex</a></li>
@stop

@section('content')
	<div class="intro">
		<p>If you have any general queries or would like to contact Fiplex before submitting a work order request, please e-mail <a href="mailto:fiplex@fipra.com">fiplex@fipra.com</a>.</p>
	</div>

	@include('forms.partials.messages')

	{{ Form::open(['files' => true, 'url' => 'fiplex']) }}
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
			{{ Form::label('email_address', 'Contact email address:', ['class' => 'required']) }}
			{{ Form::email('email_address', Input::old('email_address')) }}
			{{ display_form_error('email_address', $errors) }}
		</div>
		<div class="formfield">
			{{ Form::label('account_director', 'Account Director responsible (only applicable to Fipra International):') }}
			{{ Form::text('account_director', Input::old('account_director')) }}
			{{ display_form_error('account_director', $errors) }}
		</div>
		<div class="formfield">
			{{ Form::label('project_and_client_name', 'Project and client name (if any):', ['class' => 'required']) }}
			{{ Form::text('project_and_client_name', Input::old('project_and_client_name')) }}
			{{ display_form_error('project_and_client_name', $errors) }}
		</div>
		<div class="formfield">
			{{ Form::label('replicon_code', 'Replicon code (only applicable to Fipra International):') }}
			{{ Form::text('replicon_code', Input::old('replicon_code')) }}
			{{ display_form_error('replicon_code', $errors) }}
		</div>
		<div class="formfield">
			{{ Form::label('required_completion_date_and_time', 'Required completion date and time:', ['class' => 'required']) }}
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
			<div>{{ Form::checkbox('1', Input::old('1')) }} Service 1</div>
			<div>{{ Form::checkbox('2', Input::old('2')) }} Service 2</div>
			<div>{{ Form::checkbox('3', Input::old('3')) }} Service 3</div>
			<div>{{ Form::checkbox('other_service', Input::old('other')) }} Other</div>
		</div>
        <div class="formfield">
            {{ Form::label('other_service_info', 'If other, please give more details:') }}
            {{ Form::textarea('other_service_info', Input::old('other_service_info'), ['rows' => '3']) }}
            {{ display_form_error('other_service_info', $errors) }}
        </div>
		<div class="formfield">
			{{ Form::label('instructions', 'Any other instructions:') }}
			{{ Form::textarea('instructions', Input::old('instructions'), ['rows' => '10']) }} 
			{{ display_form_error('instructions', $errors) }}
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

	<section class="col-12" style="clear:both">
		
		{{ display_submit_button('Next') }}

		<p class="small-print">
			Please note: although every effort is made to accommodate tight deadlines and time constraints, The EDT must ensure the quality of work produced is that expected of Fipra. If a time frame and/or deadline is unrealistic the EDT will discuss with you the best course of action to complete your request as fully as possible. In the unlikely event a project time frame and/or deadline is impossible to meet, the EDT will inform you when you submit your work order request.
		</p>

		<div class="grey-box">
			<div class="col-10 last">
	            <h4>Confirmation</h4>
	            <p>Fiplex will confirm receipt of the request and deadline by return e-mail at its earliest convenience. A lawyer will then be assigned to the project and work will commence.</p>
	            
	            <h4>Completion</h4>
	            <p>When you receive an acceptable final version of your document, please send an e-mail to us to acknowledge receipt of the final document. It would also be extremely useful if you included feedback on the project and your experiences of Fiplex – this feedback is vital to us going forward.</p>
	            
	            <h4>Confidentiality</h4>
	            <p>All members of Fiplex sign a personal non-disclosure agreement with financial penalties for non-observance. The work you commission is treated confidentially by all of us and is not shared with anyone.</p>

	            <h4>Costs</h4>
	            <p>Fiplex charges a preferential rate to the Fipra Network of €125 per hour/pro rata based on time used or €1,000 per day. Cost estimates can be given in advance of agreeing work. Please note that whilst most requests will be handled as quickly as possible, it may be that the Fiplex member with the most relevant experience may not be immediately available and you must indicate if a matter is urgent.</p>

	            <h4> Invoicing</h4>
	            <p>Fiplex will invoice monthly to Fipra International who will onward bill to clients, cost centres or Members of the Fipra Network as appropriate. Fiplex operates as a "Special Adviser" would within the Network.</p>

	            <h4>Working Hours</h4>
	            <p>Fiplex is currently made up of qualified lawyers and in time will have members of the team all over Europe. Currently we work to the following office hours: Monday-Friday 09.00-18.00 Central European Time (CET).</p>
				<p>This window allows us to cater for regular and urgent advisory work in most timezones. In some cases we can be flexible on these hours to accommodate your timings and deadlines -please contact us to discuss your time frame if your instructions are time-sensitive.</p>
				<p>Please submit your request at your earliest opportunity to ensure we can plan accordingly and allocate the most suited team members.</p>
            </div>
        </div>

        <p><a href="#top" class="back-to-top">back to top</a></p>
	</section>

	{{ Form::close() }}
@stop