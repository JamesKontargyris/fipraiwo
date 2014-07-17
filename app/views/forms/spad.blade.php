@extends('layouts.master')

@section('nav_links')
	<li><a href="/" class="highlight"><i class="fa fa-caret-left"></i> Back to IWO Menu</a></li>
@stop

@section('content')
	<div class="intro">
		<p>This form confirms instructions between Fipra and Special Advisers of the Fipra Network. Please fill one out each time you engage a Special Adviser.</p>
	</div>

	@include('forms.partials.messages')

	{{ Form::open(['files' => true]) }}

		<section class="col-6">
			<div class="formgroup">
                <div class="title">Contact Details</div>
                <div class="formfield">
                    {{ Form::label('account_director', 'Fipra International Account Director:', ['class' => 'required']) }}
                    {{ Form::text('account_director', Input::old('account_director'), ['class' => 'account_director_autocomplete', 'data-email-field' => 'email_address']) }}
                    {{ display_form_error('account_director', $errors) }}
                    <span class="small-print">No Unit other than Fipra International can submit an Internal Work Order for a Special Adviser.</span>
                </div>
                <div class="formfield">
                    {{ Form::label('email_address', 'Account Director Email Address:', ['class' => 'required']) }}
                    {{ Form::text('email_address', Input::old('email_address')) }}
                    {{ display_form_error('email_address', $errors) }}
                </div>
                <div class="formfield">
                    {{ Form::label('special_adviser', 'Special Adviser Name:', ['class' => 'required']) }}
                    {{ Form::text('special_adviser', Input::old('special_adviser')) }}
                    {{ display_form_error('special_adviser', $errors) }}
                </div>
                <div class="formfield">
                    {{ Form::label('sub_email_address', 'Special Adviser Email Address:', ['class' => 'required']) }}
                    {{ Form::text('sub_email_address', Input::old('sub_email_address')) }}
                    {{ display_form_error('sub_email_address', $errors) }}
                </div>
			</div>

            <div class="formgroup">
                <div class="title">Fees</div>
                <div class="formfield">
                    {{ Form::label('the_work_will_be_done', 'The work will be done', ['class' => 'required']) }}
                    {{ Form::select('the_work_will_be_done', ['' => 'Select one of the following...', 'for a Standard Hourly Rate' => 'for a Standard Hourly Rate', 'for a Day Rate' => 'for a Day Rate', 'for a Flat/Project Fee' => 'for a Flat/Project Fee'], Input::old('the_work_will_be_done'), ['class' => 'inline']) }}
                    {{ display_form_error('the_work_will_be_done', $errors) }}
                </div>
                <div class="formfield">
                    {{ Form::label('fee_agreed', 'The agreed fee is &euro;') }}
                    {{ Form::text('fee_agreed', Input::old('flat_fee_agreed'), ['class' => 'inline', 'size' => '10']) }}
                    {{ display_form_error('fee_agreed', $errors) }}
                    {{ Form::select('fee_basis', ['' => 'Per...', 'Per Day' => 'Per Day', 'Per Week' => 'Per Week', 'Per Month' => 'Per Month', 'Per Year' => 'Per Year', 'Per Project' => 'Per Project'], Input::old('fee_basis'), ['class' => 'inline']) }}
                    {{ display_form_error('fee_basis', $errors) }}
                </div>
                <div class="formfield">
                    {{ Form::label('agreed_fee_element', 'Is there any other fee element such as a success or finders fee?', ['class' => 'required']) }}
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
                {{ Form::label('name_of_client', 'Name of client associated with the account:') }}
                {{ Form::textarea('name_of_client', Input::old('name_of_client'), ['rows' => '5']) }}
                {{ display_form_error('name_of_client', $errors) }}
            </div>
            <div class="formfield">
                {{ Form::label('project_name', 'Project name (if any):') }}
                {{ Form::text('project_name', Input::old('project_name')) }}
                {{ display_form_error('project_name', $errors) }}
            </div>
            <div class="formfield">
                {{ Form::label('replicon_code', 'Replicon Code:') }}
                {{ Form::text('replicon_code', Input::old('replicon_code')) }}
                {{ display_form_error('replicon_code', $errors) }}
            </div>
		</section>
		
		<section class="col-6 last">
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
			
			{{ display_submit_button('Next') }}

            <div class="grey-box">
                <div class="col-9 last">

                    <h4>The internal billing cycle is long, but you can help make it shorter</h4>
                    <p>As a matter of policy, Fipra generally requests payment from clients on 30-day terms. In practice clients often ignore this deadline or impose their own later payment terms. However, further delays can be avoided by Members sending in provisional bills, timesheets and invoices promptly or as early as possible, as a bill covering several Units cannot be ready until the slowest Member has sent theirs in to the Lead Unit for approval and processing.</p>

                    <h4>When should a Lead Unit pay out to subcontracting Members?</h4>
                    <p>All payments due to subcontracting Members of the Fipra Network are paid out by the Lead Unit as soon as practicable upon receipt, and not later than within 10 working days of relevant payments having been received by the Lead Unit from the final client. If a Member makes enquiries, the Lead Unit’s Account Director has an obligation to inform the other Member of when clients made payments or, if known, when they are expected to do so.</p>

                    <h4>Non-payment or reduced-payments by clients</h4>
                    <p>The Lead Unit is responsible for paying each Member of the Fipra Network in respect of services provided to a client that have been agreed and approved. Once the timesheets of a subcontracting Unit have been accepted by the relevant Account Director, and relevant amounts billed by the Lead Unit, <span class="italic">the Lead Unit will bear the risk of reduced payment, default or non-payment by the end client concerned.</span> It will thus ensure that the subcontracting Member is paid in full, if necessary at the Lead Unit's own expense. This is in order to protect subcontracting Units from large-scale defaults and from the wrongdoing of another Unit that may cause a client not to pay. It also introduces a degree of financial discipline into the work passed between Units. That a client has refused to pay at all cannot be an excuse for internal non-payment.</p>

                    <p>However, in the rare event that a client does not pay invoices, or pays less than the amount invoiced, the Lead Unit may of course seek to negotiate a reduction with the fellow Member collegially, though the subcontracting Member will not be required to enter into such negotiation.</p>

                    <h4>Internal Work Orders</h4>
                    <p>Once agreed, copies of all completed online Internal Work Orders are sent promptly to Fipra’s finance department to enable the monitoring of Inter-Unit activities and to facilitate the Membership Review. Internal Work Orders are treated as confidential and are not disclosed to any person outside the Fipra finance department. The Internal Work Orders serve to calculate the general turnover or the services performed between the Units of the Fipra Network. No Inter-Unit payment of any sort or for any work can take place without an Internal Work Order.</p>

                </div>
            </div>

            <p><a href="#top" class="back-to-top">back to top</a></p>
			
		</section>


	{{ Form::close() }}

@stop