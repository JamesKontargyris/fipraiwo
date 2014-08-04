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

    @if(editing())
        {{ Form::open(['files' => true, 'url' => 'manage/confirmupdates']) }}
    @else
        {{ Form::open(['files' => true, 'url' => 'fiplex']) }}
    @endif

    @include('forms.partials.workorder_title_ref')

    <section class="col-6">
		<div class="formfield">
			{{ Form::label('commissioned_by', 'Name of person commissioning the work:', ['class' => 'required']) }}
            @if(editing())
                {{ Form::text('commissioned_by', $workorder->workorder->commissioned_by, ['readonly' => 'readonly']) }}
            @else
                {{ Form::text('commissioned_by', Input::old('commissioned_by')) }}
            @endif
			{{ display_form_error('commissioned_by', $errors) }}
		</div>
		<div class="formfield">
			{{ Form::label('unit_or_correspondent', 'Name of Unit / Correspondent:', ['class' => 'required']) }}
			@if(editing())
                {{ Form::text('unit_or_correspondent', $workorder->workorder->unit_or_correspondent, ['readonly' => 'readonly']) }}
            @else
                {{ Form::text('unit_or_correspondent', Input::old('unit_or_correspondent')) }}
            @endif
			{{ display_form_error('unit_or_correspondent', $errors) }}
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
			{{ Form::label('project_and_client_name', 'Project and client name (if any) the work relates to:') }}
			{{ Form::text('project_and_client_name', (editing()) ? $workorder->workorder->project_and_client_name : Input::old('project_and_client_name')) }}
			{{ display_form_error('project_and_client_name', $errors) }}
		</div>
		<div class="formfield">
			{{ Form::label('replicon_code', 'Replicon code (only applicable to Fipra International):') }}
			{{ Form::text('replicon_code', (editing()) ? $workorder->workorder->replicon_code : Input::old('replicon_code')) }}
			{{ display_form_error('replicon_code', $errors) }}
		</div>
		<div class="formfield">
			{{ Form::label('required_completion_date_and_time', 'Required completion date and time:', ['class' => 'required']) }}
			{{ Form::text('required_completion_date_and_time', (editing()) ? $workorder->workorder->required_completion_date_and_time : Input::old('required_completion_date_and_time')) }}
			{{ display_form_error('required_completion_date_and_time', $errors) }}
		</div>
		<div class="formfield">
			{{ Form::label('type_of_document_or_product', 'Type of document / product:', ['class' => 'required']) }}
			{{ Form::text('type_of_product', (editing()) ? $workorder->workorder->type_of_products : Input::old('type_of_product')) }}
			{{ display_form_error('type_of_product', $errors) }}
		</div>
	</section>

	<section class="col-6 last">
		<div class="formfield">

			{{ Form::label('services_required', 'Service(s) required:', ['class' => 'required']) }}
			<div>
                {{ Form::checkbox('new_business_development_service_required', (editing()) ? $workorder->workorder->new_business_development_service_required : Input::old('new_business_development_service_required')) }} New Business Development <a href="#" class="help">&nbsp;</a>
                <div class="help-box">Issuing NDAs; engagement/services contracts with new clients.</div>
            </div>
			<div>
                {{ Form::checkbox('contract_terms_service_required', (editing()) ? $workorder->workorder->contract_terms_service_required : Input::old('contract_terms_service_required')) }} Contract Terms <a href="#" class="help">&nbsp;</a>
                <div class="help-box">Review and/or negotiation of third party (client or supplier) documentation.</div>
            </div>
            <div>
                {{ Form::checkbox('ad-hoc_advice_service_required', (editing()) ? $workorder->workorder->ad-hoc_advice_service_required : Input::old('ad-hoc_advice_service_required')) }} Ad-hoc Advice
            </div>
			<div>
                {{ Form::checkbox('compliance_service_required', (editing()) ? $workorder->workorder->compliance_service_required : Input::old('compliance_service_required')) }} Compliance <a href="#" class="help">&nbsp;</a>
                <div class="help-box">Review of any regulations, legislation or codes of practice.</div>
            </div>
            <div>
                {{ Form::checkbox('employment_service_required', (editing()) ? $workorder->workorder->employment_service_required : Input::old('employment_service_required')) }} Employment <a href="#" class="help">&nbsp;</a>
                <div class="help-box">Staff issues.</div>
            </div>
			<div>
                {{ Form::checkbox('intellectual_property_service_required', (editing()) ? $workorder->workorder->intellectual_property_service_required : Input::old('intellectual_property_service_required')) }} Intellectual Property <a href="#" class="help">&nbsp;</a>
                <div class="help-box">Protection of Fipra trademarks or documentation.</div>
            </div>
			<div>{{ Form::checkbox('other_service_required', (editing()) ? $workorder->workorder->other : Input::old('other')) }} Other</div>
		</div>
        <div class="formfield">
            {{ Form::label('other_service_info', 'If other, please give details:') }}
            {{ Form::textarea('other_service_info', (editing()) ? $workorder->workorder->other_service_info : Input::old('other_service_info'), ['rows' => '3']) }}
            {{ display_form_error('other_service_info', $errors) }}
        </div>
		<div class="formfield">
			{{ Form::label('instructions', 'Any other instructions:') }}
			{{ Form::textarea('instructions', (editing()) ? $workorder->workorder->instructions : Input::old('instructions'), ['rows' => '5']) }}
			{{ display_form_error('instructions', $errors) }}
		</div>
		<div class="formfield">
			{{ Form::label('require_cost_estimate', 'Do you require a cost estimate?', ['class' => 'required']) }}
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

	<section class="col-12" style="clear:both">
		
		{{ display_submit_button('Next') }}

		<p class="small-print">
            Please note: although every effort is made to accommodate tight deadlines and time constraints, Fiplex must ensure the quality of work produced is that expected of Fipra. If a time frame and/or deadline is unrealistic the Fiplex team will discuss with you the best course of action to complete your request as fully as possible. In the unlikely event a project time frame and/or deadline is impossible to meet, the Fiplex team will inform you when you submit your work order request.
		</p>

		<div class="grey-box">
			<div class="col-10 last">
	            <h4>Confirmation</h4>
	            <p>Fiplex will confirm receipt of the request and deadline by return e-mail as soon as possible. A lawyer will then be assigned to the project and work will commence.</p>
	            
	            <h4>Completion</h4>
	            <p>When you receive an acceptable final version of your document, please send an e-mail to us to acknowledge receipt of the final document. It would also be extremely useful if you included feedback on the project and your experiences of Fiplex – this feedback is vital to us going forward.</p>
	            
	            <h4>Confidentiality</h4>
	            <p>All members of Fiplex sign a personal non-disclosure agreement. The work you commission is treated confidentially by all of us and is not shared with anyone.</p>

	            <h4>Costs</h4>
	            <p>Fiplex charges a preferential rate to the Fipra Network of €125 per hour/pro rata based on time used or €1,000 per day. Cost estimates can be given in advance of agreeing work. Please note that whilst most requests will be handled as quickly as possible, it may be that the Fiplex member with the most relevant experience may not be immediately available and you must indicate where a matter is urgent.</p>

                <h4>Work in Progress</h4>
                <p>The Fiplex member working on your project will keep you advised as to progress, and it is important that you keep them involved in the commercial discussions that are taking place alongside any legal negotiation to ensure that they are fully up to date on your plans and objectives and have all the relevant information necessary to draft documents or negotiate changes on your behalf.</p>

	            <h4>Invoicing</h4>
	            <p>Fiplex will invoice monthly to Fipra International who will onward bill to clients, cost centres or Members of the Fipra Network as appropriate. Fiplex operates as a "Special Adviser" would within the Network.</p>

	            <h4>Working Hours</h4>
	            <p>Fiplex is currently made up of trained lawyers and in time will have members of the team all over Europe. Currently we work to the following office hours: Monday-Friday 09.00-18.00 Central European Time (CET).</p>
                    <p>This window allows us to cater for regular and urgent advisory work in most timezones. In some cases we can be flexible on these hours to accommodate your timings and deadlines -please contact us to discuss your time frame if your instructions are time-sensitive.</p>
            </div>
        </div>

        <p><a href="#top" class="back-to-top">back to top</a></p>
	</section>

	{{ Form::close() }}

    <script type="text/javascript" src="{{ asset('js/fiplexWorkOrder.js') }}"></script>
@stop