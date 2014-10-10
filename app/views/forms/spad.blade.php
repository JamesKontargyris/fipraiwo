@extends('layouts.master')

@section('nav_links')
	<li><a href="/" class="highlight"><i class="fa fa-caret-left"></i> Back to IWO Menu</a></li>
@stop

@section('content')
	<div class="intro">
		<p>This form confirms instructions between Fipra International and its Special Advisers, who are full members of the Fipra Network. Please fill one out each time you engage a Special Adviser.</p>
		<p><strong>Please note: all amounts quoted are gross, i.e. before the inter unit discount.</strong></p>
		@if(editing())
			<p class="red">Fields in red cannot be edited.</p>
		@endif
	</div>

	@include('forms.partials.messages')

    @if(editing())
    {{ Form::open(['files' => true, 'url' => 'manage/confirmupdates']) }}
    @else
    {{ Form::open(['files' => true, 'url' => 'spad']) }}
    @endif

    @include('forms.partials.workorder_title_ref')

		<section class="col-6">
			<div class="formgroup">
                <div class="title">Contact Details</div>

                <div class="formfield">
					{{ Form::label('special_adviser_instructed', 'Special Adviser instructed:', ['class' => 'required']) }}
					@if(editing())
						{{ Form::text('special_adviser_instructed', isset($workorder->workorder->special_adviser_instructed) ? $workorder->workorder->special_adviser_instructed : '', ['class' => 'spad_reps_autocomplete', 'data-rep-field' => 'sub_fipra_representative', 'readonly' => 'readonly']) }}
					@else
						{{ Form::text('special_adviser_instructed', Input::old('special_adviser_instructed'), ['class' => 'spad_reps_autocomplete', 'data-rep-field' => 'sub_fipra_representative', 'data-email-field' => 'sub_email_address']) }}
					@endif
					{{ display_form_error('special_adviser_instructed', $errors) }}
				</div>
				<div class="formfield">
					{{ Form::label('sub_email_address', 'Special Adviser Email Address:', ['class' => 'required']) }}
					@if(editing())
						{{ Form::text('sub_email_address', isset($workorder->workorder->sub_email_address) ? $workorder->workorder->sub_email_address : '', ['readonly' => 'readonly']) }}
					@else
						{{ Form::text('sub_email_address', Input::old('sub_email_address')) }}
					@endif
					{{ display_form_error('sub_email_address', $errors) }}
				</div>
                <div class="formfield">
                    {{ Form::label('account_director', 'Account Director responsible for this instruction:', ['class' => 'required']) }}
                    @if(editing())
                        {{ Form::text('account_director', isset($workorder->workorder->account_director) ? $workorder->workorder->account_director : '', ['class' => 'account_director_autocomplete', 'data-email-field' => 'lead_email_address', 'readonly' => 'readonly']) }}
                    @else
                        {{ Form::text('account_director', Input::old('account_director'), ['class' => 'account_director_autocomplete', 'data-email-field' => 'lead_email_address']) }}
                    @endif
                    {{ display_form_error('account_director', $errors) }}
                    <span class="small-print">No Unit other than Fipra International can submit an Internal Work Order for a Special Adviser.</span>
                </div>
                <div class="formfield">
                    {{ Form::label('lead_email_address', 'Account Director Email Address:', ['class' => 'required']) }}
                    @if(editing())
                        {{ Form::text('lead_email_address', isset($workorder->workorder->lead_email_address) ? $workorder->workorder->lead_email_address : '', ['readonly' => 'readonly']) }}
                    @else
                        {{ Form::text('lead_email_address', Input::old('lead_email_address')) }}
                    @endif
                    {{ display_form_error('lead_email_address', $errors) }}
                </div>

                <div class="formfield">
                    {{ Form::label('sub_fipra_representative', 'Fipra Representative:', ['class' => 'required']) }}
                    @if(editing())
                    	{{ Form::text('sub_fipra_representative', isset($workorder->workorder->sub_fipra_representative) ? $workorder->workorder->sub_fipra_representative : '', ['style' => 'width:100%', 'readonly' => 'readonly']) }}
                    @else
                    	{{ Form::select('sub_fipra_representative', get_fipra_reps(), Input::old('sub_fipra_representative'), ['style' => 'width:100%']) }}
                    @endif
                    {{ display_form_error('sub_fipra_representative', $errors) }}
                </div>
			</div>

            <div class="formgroup">
                <div class="title">Fees <small>before inter-unit discount</small></div>
                <div class="formfield">
                    {{ Form::label('the_work_will_be_done', 'The work will be done', ['class' => 'required']) }}
                    {{ Form::select('the_work_will_be_done', ['' => 'Select one of the following...', 'at the standard Fipra hourly rate' => 'at the standard Fipra hourly rate', 'at a different Fipra hourly rate' => 'at a different Fipra hourly rate', 'at a flat or project rate' => 'at a flat or project rate'], (editing()) ? isset($workorder->workorder->the_work_will_be_done) ? $workorder->workorder->the_work_will_be_done : '' : Input::old('the_work_will_be_done'), ['class' => 'inline', 'id' => 'the-work-will-be-done']) }}

                    <div class="sub-box rate-field col-12">
                        {{ Form::label('rate_is', 'Rate:', ['class' => 'required rate-label']) }}
						<span class="inline bold"><br/>&euro;</span> {{ Form::text('rate_is', (editing()) ? isset($workorder->workorder->rate_is) ? $workorder->workorder->rate_is : '' : Input::old('rate_is'), ['class' => 'inline-field']) }}
                        {{ display_form_error('rate_is', $errors) }}

                    </div>
                    {{ display_form_error('the_work_will_be_done', $errors) }}

                </div>
                <div class="formfield">
                    {{ Form::label('agreed_fee_element', 'Is there any other fee element such as a success or finders fee?', ['class' => 'required']) }}
                    {{ Form::select('agreed_fee_element', ['No' => 'No', 'Yes' => 'Yes'], (editing()) ? isset($workorder->workorder->agreed_fee_element) ? $workorder->workorder->agreed_fee_element : '' : Input::old('agreed_fee_element'), ['class' => 'agreed-fee-element']) }}
                    {{ display_form_error('agreed_fee_element', $errors) }}
                </div>
                <div class="formfield hide" id="agreed-fee-element-reveal">
                    {{ Form::label('agreed_fee_element_details', 'Please set out fee element details:', ['class' => 'required']) }}
                    {{ Form::textarea('agreed_fee_element_details', (editing()) ? isset($workorder->workorder->agreed_fee_element_details) ? $workorder->workorder->agreed_fee_element_details : '' : Input::old('agreed_fee_element_details'), ['rows' => '10']) }}
                    {{ display_form_error('agreed_fee_element_details', $errors) }}
                </div>
                <div class="formfield">
                    {{ Form::label('work_capped_at_maximum_level', 'Is this work capped at a maximum level?', ['class' => 'required']) }}
                    {{ Form::select('work_capped_at_maximum_level', ['No' => 'No', 'Yes' => 'Yes'], (editing()) ? isset($workorder->workorder->work_capped_at_maximum_level) ? $workorder->workorder->work_capped_at_maximum_level : '' : Input::old('work_capped_at_maximum_level'), ['class' => 'work-capped-at-maximum-level']) }}
                    {{ display_form_error('work_capped_at_maximum_level', $errors) }}
                </div>
                <div class="formfield hide" id="work-capped-at-maximum-level-reveal">
					{{ Form::label('work_cap', 'Work Cap:') }}
					<span class="inline bold"><br/>&euro;</span> {{ Form::text('work_cap', (editing()) ? isset($workorder->workorder->work_cap) ? $workorder->workorder->work_cap : '' : Input::old('work_cap'), ['class' => 'inline-field']) }}
					{{ Form::select('work_cap_period', ['Per month' => 'per month', 'for the duration of the IWO' => 'For the duration of the IWO'], (editing()) ? isset($workorder->workorder->work_cap_period) ? $workorder->workorder->work_cap_period : '' : Input::old('work_cap_period'), ['class' => 'work-cap-period']) }}
					{{ display_form_error('work_cap', $errors) }}
				</div>
            </div> <!-- /formgroup -->
		</section>
		
		<section class="col-6 last">
            <div class="formfield">
                {{ Form::label('name_of_client_company', 'Name of client company associated with the account:') }}
                {{ Form::text('name_of_client_company', (editing()) ? isset($workorder->workorder->name_of_client_company) ? $workorder->workorder->name_of_client_company : '' : Input::old('name_of_client_company')) }}
                {{ display_form_error('name_of_client_company', $errors) }}
            </div>
            <div class="formfield">
                {{ Form::label('project_name', 'Project name (if any):') }}
                {{ Form::text('project_name', (editing()) ? isset($workorder->workorder->project_name) ? $workorder->workorder->project_name : '' : Input::old('project_name')) }}
                {{ display_form_error('project_name', $errors) }}
            </div>
            <div class="formfield">
                {{ Form::label('replicon_code', 'Replicon Code:') }} <a href="#" class="help">&nbsp;</a>
                <div class="help-box">Replicon codes are Fipra's internal timesheet codes.</div>
                {{ Form::text('replicon_code', (editing()) ? isset($workorder->workorder->replicon_code) ? $workorder->workorder->replicon_code : '' : Input::old('replicon_code')) }}
                {{ display_form_error('replicon_code', $errors) }}
            </div>
            <div class="formfield">
                {{ Form::label('scope_of_service', 'Scope of Service:', ['class' => 'required']) }} <a href="#" class="help">&nbsp;</a>
                <div class="help-box">Set out a description of the services to be performed in reasonable detail.</div>
                {{ Form::textarea('scope_of_service', (editing()) ? isset($workorder->workorder->scope_of_service) ? $workorder->workorder->scope_of_service : '' : Input::old('scope_of_service'), ['rows' => '5']) }}
                {{ display_form_error('scope_of_service', $errors) }}
            </div>
            <div class="formfield">
                {{ Form::label('deliverables', 'Deliverables:', ['class' => 'required']) }} <a href="#" class="help">&nbsp;</a>
                <div class="help-box">Set out the nature of any deliverables in reasonable detail.</div>
                {{ Form::textarea('deliverables', (editing()) ? isset($workorder->workorder->deliverables) ? $workorder->workorder->deliverables : '' : Input::old('deliverables'), ['rows' => '5']) }}
                {{ display_form_error('deliverables', $errors) }}
            </div>
            <div class="formfield">
                {{ Form::label('internal_work_order_start_date', 'IWO start date:', ['class' => 'required']) }} <a href="#" class="help">&nbsp;</a>
                <div class="help-box">The Start date is from when payments can be made under this IWO.</div>
                {{ Form::text('internal_work_order_start_date', (editing()) ? isset($workorder->workorder->internal_work_order_start_date) ? $workorder->workorder->internal_work_order_start_date : '' : Input::old('internal_work_order_start_date'), ['class' => 'datepicker']) }}
                {{ display_form_error('internal_work_order_start_date', $errors) }}
            </div>
            <div class="formfield">
                {{ Form::label('internal_work_order_expiry_date', 'IWO expiry date:', ['class' => 'required']) }} <a href="#" class="help">&nbsp;</a>
                <div class="help-box">This is the date payment will stop under this IWO.</div>
                {{ Form::text('internal_work_order_expiry_date', (editing()) ? isset($workorder->workorder->internal_work_order_expiry_date) ? $workorder->workorder->internal_work_order_expiry_date : '' : Input::old('internal_work_order_expiry_date'), ['class' => 'datepicker']) }}
                {{ display_form_error('internal_work_order_expiry_date', $errors) }}
            </div>

			<div class="formfield">
				{{ Form::label('green_sheet_required', 'Is a Fipra Green Sheet required at the end of each month?', ['class' => 'required']) }} <a href="#" class="help">&nbsp;</a>
				<div class="help-box">Green Sheets are to be submitted within three working days of the end of the month in which the work has been performed. Green Sheets give details of the hours worked and are irrespective of the type of fee structure chosen above.</div>
				{{ Form::select('green_sheet_required', ['No' => 'No', 'Yes' => 'Yes'], (editing()) ? isset($workorder->workorder->green_sheet_required) ? $workorder->workorder->green_sheet_required : '' : Input::old('green_sheet_required'), ['class' => 'green-sheet-required']) }}
				{{ display_form_error('green_sheet_required', $errors) }}
			</div>
			<div class="formfield hide" id="green-sheet-required-reveal">
				@include('forms.partials.green_sheet_links')
				<span class="small-print">Green Sheets are to be submitted within three working days of the end of the month in which the work has been performed. Green Sheets give details of the hours worked, irrespective of the type of fee structure chosen above. Please Click here to download a Greensheet template.</span>
			</div>
			<div class="formfield">
				{{ Form::label('other_information', 'Any other relevant information including variants on terms:') }}
				{{ Form::textarea('other_information', (editing()) ? isset($workorder->workorder->other_information) ? $workorder->workorder->other_information : '' : Input::old('other_information'), ['rows' => '10']) }}
				{{ display_form_error('other_information', $errors) }}
			</div>
		</section>

		@include('forms.partials.copy_emails')

		<section class="col-12" style="clear:both">
			
			{{ display_submit_button('Next') }}

            <div class="grey-box">
                <div class="col-10 last">

                    <h4>Engaging Special Advisers / other external advisers</h4>
                    <p>Where a Lead Unit that has contracted a client requires the services of a Special Adviser, all agreements with that Special Adviser, including Internal Work Orders and invoicing, must be made through Fipra International. Special Advisers are individuals (as opposed to Units that are typically companies with staff). As most are very senior or retired persons this rule gives each Special Adviser just one billing and instruction point, making administration easier and more streamlined.</p>

                    <h4>The internal billing cycle is long, but you can help make it shorter</h4>
                    <p>As a matter of policy, Fipra generally requests payment from clients on 30-day terms. In practice clients often ignore this deadline or impose their own later payment terms. However, further delays can be avoided - by all Members sending in Internal Work Orders, provisional bills, timesheets and invoices as promptly as possible. A bill covering several Units cannot be ready until the slowest Member has sent theirs in to the Lead Unit for approval and processing.</p>

                    <h4>When will Fipra International pay you?</h4>
                    <p>All payments are made no later than within 10 working days of the relevant payment having been received by Fipra International from the final client. If a Member asks, the Account Director has an obligation to inform the other Member of when clients made payments or, if known, when they are expected to do so. However Fipra International will not automatically inform members when each payment is received by us.</p>

                    <h4>Non-payment or reduced-payments by clients</h4>
                    <p>Fipra International is responsible for paying each Special Adviser in respect of services provided to a client that have been agreed and approved. Once the timesheets of a subcontracting Special Adviser have been accepted by the relevant Account Director, and relevant amounts billed to the client by Fipra, Fipra will bear the risk of reduced payment, default or non-payment by the end client concerned. It will thus ensure that the subcontracting Member is paid in full, if necessary at Fipra International’s own expense. That a client has refused to pay at all cannot be an excuse for internal non-payment.</p>

                    <p>However, in the rare event that a client does not pay invoices, or pays less than the amount invoiced, Fipra International may of course seek to negotiate a reduction with the fellow Member collegially, though the Special Adviser will not be required to enter into such negotiation.</p>

                    <h4>Internal Work Orders</h4>
                    <p>Once agreed, copies of all completed online Internal Work Orders are sent promptly to Fipra’s finance department to enable the monitoring of Inter-Unit activities and to facilitate the Membership Review. Internal Work Orders are treated as confidential and are not disclosed to any person outside the Fipra finance department with exception of the Fipra Representative, the person at Fipra who has the key relationship with the Special Adviser concerned. Internal Work Orders also serve to calculate the general turnover or the services performed between the Units of the Fipra Network.</p>

                    <p>Remember, no payment of any sort or for any work can take place without an Internal Work Order.</p>

                </div>
            </div>

            <p><a href="#top" class="back-to-top">back to top</a></p>
			
		</section>


	{{ Form::close() }}

    <script type="text/javascript" src="{{ asset('js/spadWorkOrder.js') }}"></script>
@stop