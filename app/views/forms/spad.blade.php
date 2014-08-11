@extends('layouts.master')

@section('nav_links')
	<li><a href="/" class="highlight"><i class="fa fa-caret-left"></i> Back to IWO Menu</a></li>
@stop

@section('content')
	<div class="intro">
		<p>This form confirms instructions between Fipra and Special Advisers of the Fipra Network. Please fill one out each time you engage a Special Adviser.</p>
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
                    {{ Form::label('account_director', 'Account Director responsible:', ['class' => 'required']) }}
                    @if(editing())
                        {{ Form::text('account_director', $workorder->workorder->account_director, ['class' => 'account_director_autocomplete', 'data-email-field' => 'lead_email_address', 'readonly' => 'readonly']) }}
                    @else
                        {{ Form::text('account_director', Input::old('account_director'), ['class' => 'account_director_autocomplete', 'data-email-field' => 'lead_email_address']) }}
                    @endif
                    {{ display_form_error('account_director', $errors) }}
                    <span class="small-print">No Unit other than Fipra International can submit an Internal Work Order for a Special Adviser.</span>
                </div>
                <div class="formfield">
                    {{ Form::label('lead_email_address', 'Email Address:', ['class' => 'required']) }}
                    @if(editing())
                        {{ Form::text('lead_email_address', $workorder->workorder->lead_email_address, ['readonly' => 'readonly']) }}
                    @else
                        {{ Form::text('lead_email_address', Input::old('lead_email_address')) }}
                    @endif
                    {{ display_form_error('lead_email_address', $errors) }}
                </div>
                <div class="formfield">
                    {{ Form::label('special_adviser', 'Special Adviser instructed:', ['class' => 'required']) }}
                    @if(editing())
                        {{ Form::text('special_adviser', $workorder->workorder->special_adviser, ['class' => 'spad_reps_autocomplete', 'data-rep-field' => 'fipra_representative', 'readonly' => 'readonly']) }}
                    @else
                        {{ Form::text('special_adviser', Input::old('special_adviser'), ['class' => 'spad_reps_autocomplete', 'data-rep-field' => 'fipra_representative']) }}
                    @endif
                    {{ display_form_error('special_adviser', $errors) }}
                </div>
                <div class="formfield">
                    {{ Form::label('sub_email_address', 'Email Address:', ['class' => 'required']) }}
                    @if(editing())
                        {{ Form::text('sub_email_address', $workorder->workorder->sub_email_address, ['readonly' => 'readonly']) }}
                    @else
                        {{ Form::text('sub_email_address', Input::old('sub_email_address')) }}
                    @endif
                    {{ display_form_error('sub_email_address', $errors) }}
                </div>
                <div class="formfield">
                    {{ Form::label('fipra_representative', 'Fipra Representative:', ['class' => 'required']) }}
                    {{ Form::text('fipra_representative', (editing()) ? $workorder->workorder->fipra_representative : Input::old('fipra_representative')) }}
                    {{ display_form_error('fipra_representative', $errors) }}
                </div>
			</div>

            <div class="formgroup">
                <div class="title">Fees</div>
                <div class="formfield">
                    {{ Form::label('the_work_will_be_done', 'The work will be done', ['class' => 'required']) }}
                    {{ Form::select('the_work_will_be_done', ['' => 'Select one of the following...', 'at the standard Fipra hourly rates' => 'at the standard Fipra hourly rates', 'at a different Fipra hourly rate' => 'at a different Fipra hourly rate', 'at a day rate' => 'at a day rate', 'at a flat or project rate' => 'at a flat or project rate'], (editing()) ? $workorder->workorder->the_work_will_be_done : Input::old('the_work_will_be_done'), ['class' => 'inline', 'id' => 'the-work-will-be-done']) }}

                    <div class="sub-box rate-field">
                        {{ Form::label('rate_is', ' Rate is (&euro;):', ['class' => 'required rate-label']) }}
                        {{ Form::text('rate_is', (editing()) ? $workorder->workorder->rate_is : Input::old('rate_is'), ['class' => 'euro-field']) }}
                        {{ display_form_error('rate_is', $errors) }}

                    </div>
                    {{ display_form_error('the_work_will_be_done', $errors) }}

                </div>
                <div class="formfield">
                    {{ Form::label('agreed_fee_element', 'Is there any other fee element such as a success or finders fee?', ['class' => 'required']) }}
                    {{ Form::select('agreed_fee_element', ['No' => 'No', 'Yes' => 'Yes'], (editing()) ? $workorder->workorder->agreed_fee_element : Input::old('agreed_fee_element'), ['class' => 'agreed-fee-element']) }}
                    {{ display_form_error('agreed_fee_element', $errors) }}
                </div>
                <div class="formfield hide" id="agreed-fee-element-reveal">
                    {{ Form::label('agreed_fee_element_details', 'Please set out fee element details:', ['class' => 'required']) }}
                    {{ Form::textarea('agreed_fee_element_details', (editing()) ? $workorder->workorder->agreed_fee_element_details : Input::old('agreed_fee_element_details'), ['rows' => '10']) }}
                    {{ display_form_error('agreed_fee_element_details', $errors) }}
                </div>
                <div class="formfield">
                    {{ Form::label('work_capped_each_month', 'Is this work capped at a maximum level each month?', ['class' => 'required']) }}
                    {{ Form::select('work_capped_each_month', ['No' => 'No', 'Yes' => 'Yes'], (editing()) ? $workorder->workorder->work_capped_each_month : Input::old('work_capped_each_month'), ['class' => 'work-capped-each-month']) }}
                    {{ display_form_error('work_capped_each_month', $errors) }}
                </div>
                <div class="formfield hide" id="work-capped-each-month-reveal">
                    {{ Form::label('work_cap', 'What is the cap?') }}
                    {{ Form::text('work_cap', (editing()) ? $workorder->workorder->work_cap : Input::old('work_cap')) }}
                    {{ display_form_error('work_cap', $errors) }}
                </div>
            </div> <!-- /formgroup -->
		</section>
		
		<section class="col-6 last">
            <div class="formfield">
                {{ Form::label('name_of_client', 'Name of client associated with the account:') }}
                {{ Form::text('name_of_client', (editing()) ? $workorder->workorder->name_of_client : Input::old('name_of_client')) }}
                {{ display_form_error('name_of_client', $errors) }}
            </div>
            <div class="formfield">
                {{ Form::label('project_name', 'Project name (if any):') }}
                {{ Form::text('project_name', (editing()) ? $workorder->workorder->project_name : Input::old('project_name')) }}
                {{ display_form_error('project_name', $errors) }}
            </div>
            <div class="formfield">
                {{ Form::label('replicon_code', 'Replicon Code:') }} <a href="#" class="help">&nbsp;</a>
                <div class="help-box">Replicon codes are Fipra's internal timesheet codes.</div>
                {{ Form::text('replicon_code', (editing()) ? $workorder->workorder->replicon_code : Input::old('replicon_code')) }}
                {{ display_form_error('replicon_code', $errors) }}
            </div>
            <div class="formfield">
                {{ Form::label('scope_of_service', 'Scope of Service:', ['class' => 'required']) }} <a href="#" class="help">&nbsp;</a>
                <div class="help-box">Set out a description of the services to be performed in reasonable detail.</div>
                {{ Form::textarea('scope_of_service', (editing()) ? $workorder->workorder->scope_of_service : Input::old('scope_of_service'), ['rows' => '5']) }}
                {{ display_form_error('scope_of_service', $errors) }}
            </div>
            <div class="formfield">
                {{ Form::label('deliverables', 'Deliverables:', ['class' => 'required']) }} <a href="#" class="help">&nbsp;</a>
                <div class="help-box">Set out the nature of any deliverables in reasonable detail.</div>
                {{ Form::textarea('deliverables', (editing()) ? $workorder->workorder->deliverables : Input::old('deliverables'), ['rows' => '5']) }}
                {{ display_form_error('deliverables', $errors) }}
            </div>
            <div class="formfield">
                {{ Form::label('internal_work_order_start_date', 'IWO start date:', ['class' => 'required']) }} <a href="#" class="help">&nbsp;</a>
                <div class="help-box">The Start date is from when payments can be made under this IWO.</div>
                {{ Form::text('internal_work_order_start_date', (editing()) ? $workorder->workorder->internal_work_order_start_date : Input::old('internal_work_order_start_date'), ['class' => 'datepicker']) }}
                {{ display_form_error('internal_work_order_start_date', $errors) }}
            </div>
            <div class="formfield">
                {{ Form::label('internal_work_order_expiry_date', 'IWO expiry date:', ['class' => 'required']) }} <a href="#" class="help">&nbsp;</a>
                <div class="help-box">This is the date payment will stop under this IWO.</div>
                {{ Form::text('internal_work_order_expiry_date', (editing()) ? $workorder->workorder->internal_work_order_expiry_date : Input::old('internal_work_order_expiry_date'), ['class' => 'datepicker']) }}
                {{ display_form_error('internal_work_order_expiry_date', $errors) }}
            </div>

			<div class="formfield">
				{{ Form::label('green_sheet_required', 'Is a Fipra Green Sheet required at the end of each month?', ['class' => 'required']) }} <a href="#" class="help">&nbsp;</a>
				<div class="help-box">Green Sheets are to be submitted within three working days of the end of the month in which the work has been performed. Green Sheets give details of the hours worked, irrespective of the type of fee structure chosen above. Please Click here to download a Greensheet template.</div>
				{{ Form::select('green_sheet_required', ['No' => 'No', 'Yes' => 'Yes'], (editing()) ? $workorder->workorder->green_sheet_required : Input::old('green_sheet_required')) }}
				{{ display_form_error('green_sheet_required', $errors) }}
			</div>
			<div class="formfield">
				{{ Form::label('other_information', 'Any other relevant information including variants on terms:') }}
				{{ Form::textarea('other_information', (editing()) ? $workorder->workorder->other_information : Input::old('other_information'), ['rows' => '10']) }}
				{{ display_form_error('other_information', $errors) }}
			</div>
		</section>

		<section class="col-12" style="clear:both">
			
			{{ display_submit_button('Next') }}

            <div class="grey-box">
                <div class="col-10 last">

                    <h4>Engaging Special Advisers / other external advisers</h4>
                    <p>Where a Lead Unit that has contracted a client requires the services of a Special Adviser, all agreements with that Special Adviser, including Internal Work Orders and invoicing, must be made through Fipra International. Special Advisers are individuals (as opposed to Units that are typically companies with staff). As most are very senior or retired persons this rule gives each Special Adviser just one billing and instruction point, making administration easier and more streamlined.</p>

                    <h4>The internal billing cycle is long, but you can help make it shorter</h4>
                    <p>As a matter of policy, Fipra generally requests payment from clients on 30-day terms. In practice clients often ignore this deadline or impose their own later payment terms. However, further delays can be avoided - by all Members sending in Internal Work Orders, provisional bills, timesheets and invoices as promptly as possible. A bill covering several Units cannot be ready until the slowest Member has sent theirs in to the Lead Unit for approval and processing.</p>

                    <h4>When will Fipra International pay you?</h4>
                    <p>All payments are made no later than within 10 working days of the relevant payment having been received by Fipra International from the final client or instructing Fipra Unit. If a Member asks, the Account Director has an obligation to inform the other Member of when clients made payments or, if known, when they are expected to do so. However Fipra International will not automatically inform members when each payment is received by us.</p>

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