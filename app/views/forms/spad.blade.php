@extends('layouts.master')

@section('nav_links')
	<li><a href="/" class="highlight"><i class="fa fa-caret-left"></i> Back to IWO Menu</a></li>
@stop

@section('content')
	<div class="intro">
		<p>This form confirms instructions between Fipra and Special Advisers of the Fipra Network. Please fill one out each time you engage a Special Adviser.</p>
	</div>
	<div>
		<p><span class="red">*</span> = required <span class="showjs">| Click <span class="help">&nbsp;</span> for help</span></p>
	</div>
	
	@include('forms.partials.messages')

	{{ Form::open(['files' => true]) }}

		<section class="col-6">
			
			<div class="formfield">
				{{ Form::label('account_director', 'Account Director:', ['class' => 'required']) }}
				{{ Form::text('account_director', Input::old('account_director')) }}
				{{ display_form_error('account_director', $errors) }}
			</div>
			<div class="formfield">
				{{ Form::label('special_adviser', 'Special Adviser:', ['class' => 'required']) }}
				{{ Form::text('special_adviser', Input::old('special_adviser')) }}
				{{ display_form_error('special_adviser', $errors) }}
			</div>
			<div class="formfield">
				{{ Form::label('ultimate_client', 'Ultimate client:') }}
				{{ Form::textarea('ultimate_client', Input::old('ultimate_client'), ['rows' => '5']) }}
				{{ display_form_error('ultimate_client', $errors) }}
			</div>
			<div class="formfield">
				{{ Form::label('project_name', 'Project name (if any):') }}
				{{ Form::text('project_name', Input::old('project_name')) }}
				{{ display_form_error('project_name', $errors) }}
			</div>
			<div class="formfield">
				{{ Form::label('scope_of_service', 'Scope of Service:', ['class' => 'required']) }} <a href="#" class="help">&nbsp;</a>
				<div class="help-box">Set out a description of the services to be performed in reasonable detail.</div>
				{{ Form::textarea('scope_of_service', Input::old('scope_of_service'), ['rows' => '5']) }}
				{{ display_form_error('scope_of_service', $errors) }}
			</div>
			<div class="formfield">
				{{ Form::label('deliverables', 'Deliverables:', ['class' => 'required']) }} <a href="#" class="help">&nbsp;</a>
				<div class="help-box">Set out the nature of any deliverables in reasonable detail.</div>
				{{ Form::textarea('deliverables', Input::old('deliverables'), ['rows' => '5']) }}
				{{ display_form_error('deliverables', $errors) }}
			</div>
			<div class="formfield">
				{{ Form::label('time_frame', 'Time frame:', ['class' => 'required']) }} <a href="#" class="help">&nbsp;</a>
				<div class="help-box">Set out any agreed time frame for completion of the work or deliverable.</div>
				{{ Form::textarea('time_frame', Input::old('time_frame'), ['rows' => '5']) }}
				{{ display_form_error('time_frame', $errors) }}
			</div>
		</section>
		
		<section class="col-6 last">
			<div class="formgroup">
				<div class="title">Fees</div>
				<div class="formfield">
					{{ Form::label('standard_hourly_rate_applies', 'Does standard hourly rate apply?', ['class' => 'required']) }}
					{{ Form::select('standard_hourly_rate_applies', ['Yes' => 'Yes', 'No' => 'No'], Input::old('standard_hourly_rate_applies'), ['class' => 'inline']) }}
					{{ display_form_error('standard_hourly_rate_applies', $errors) }}
				</div>
				<div class="formfield">
					{{ Form::label('flat_fee_agreed', 'Flat fee agreed is &euro;') }}
					{{ Form::text('flat_fee_agreed', Input::old('flat_fee_agreed'), ['class' => 'inline', 'size' => '10']) }}
					{{ display_form_error('flat_fee_agreed', $errors) }}
					{{ Form::select('flat_fee_basis', ['' => 'Per...', 'Per Day' => 'Per Day', 'Per Week' => 'Per Week', 'Per Month' => 'Per Month', 'Per Year' => 'Per Year'], Input::old('flat_fee_basis'), ['class' => 'inline']) }}
					{{ display_form_error('flat_fee_basis', $errors) }}
				</div>
				<div class="formfield">
					{{ Form::label('agreed_fee_element', 'Success fee / finders fee / any other agreed fee element?', ['class' => 'required']) }}
					{{ Form::select('agreed_fee_element', ['No' => 'No', 'Yes' => 'Yes'], Input::old('agreed_fee_element'), ['class' => 'agreed-fee-element']) }}
					{{ display_form_error('agreed_fee_element', $errors) }}
				</div>
				<div class="formfield hide" id="agreed-fee-element-reveal">
					{{ Form::label('agreed_fee_element_details', 'Please set out fee element details:', ['class' => 'required']) }}
					{{ Form::textarea('agreed_fee_element_details', Input::old('agreed_fee_element_details'), ['rows' => '10']) }}
					{{ display_form_error('agreed_fee_element_details', $errors) }}
				</div>
			</div> <!-- /formgroup -->

			<div class="formfield">
				{{ Form::label('green_sheet_required', 'Is a Fipra Green Sheet required at the end of each month?', ['class' => 'required']) }} <a href="#" class="help">&nbsp;</a>
				<div class="help-box">Green Sheets to be submitted within one week of the end of the month in which the work has been performed. (Download link here?)</div>
				{{ Form::select('green_sheet_required', ['No' => 'No', 'Yes' => 'Yes'], Input::old('green_sheet_required')) }}
				{{ display_form_error('green_sheet_required', $errors) }}
			</div>
			<div class="formfield">
				{{ Form::label('other_information', 'Other information:') }}
				{{ Form::textarea('other_information', Input::old('other_information'), ['rows' => '10']) }}
				{{ display_form_error('other_information', $errors) }}
			</div>
			<div class="formfield">
				{{ Form::label('written_contract_exists', 'Does a written contract exist at the time of commissioning this sheet between the Lead Unit and the Client?', ['class' => 'required']) }}
				{{ Form::select('written_contract_exists', ['No' => 'No', 'Yes' => 'Yes'], Input::old('written_contract_exists')) }}
				{{ display_form_error('written_contract_exists', $errors) }}
			</div>
		</section>

		<section class="col-12">
			
			@include('forms.partials.registered_email')
			
			{{ display_submit_button('Next') }}
			
		</section>


	{{ Form::close() }}

@stop