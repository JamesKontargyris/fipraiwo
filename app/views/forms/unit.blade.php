@extends('layouts.master')

@section('nav_links')
	<li><a href="/" class="highlight"><i class="fa fa-caret-left"></i> Back to IWO Menu</a></li>
@stop

@section('content')

	<div class="intro">
        <p>This form confirms financial instructions between Members of the Fipra Network. Please fill one form out each time you subcontract a Unit.</p>
        <p class="italic small-print">Please see full explanatory notes at the end of the page.</p>
	</div>

	@include('forms.partials.messages')

	{{ Form::open(['files' => true]) }}

		<section class="col-6">
			<div class="formgroup">
                <div class="title">Lead Unit</div>
                <div class="formfield">
                    {{ Form::label('lead_unit', 'Lead Unit:', ['class' => 'required']) }} <a href="#" class="help">&nbsp;</a>
                    <div class="help-box">The Unit responsible for managing a particular client relationship or instruction, including with regard to financial arrangements with that client, where that client requires advice in more than one territory. It is the Lead Unit, and not the subcontracting Unit, that bears ultimate responsibility to the client for quality control.</div>
                    {{ Form::text('lead_unit', Input::old('lead_unit')) }}
                    {{ display_form_error('lead_unit', $errors) }}
                </div>
                <div class="formfield">
                    {{ Form::label('lead_unit_account_director', 'Account Director responsible at the Lead Unit:', ['class' => 'required']) }}
                    {{ Form::text('lead_unit_account_director', Input::old('lead_unit_account_director'), ['class' => 'account_director_autocomplete', 'data-email-field' => 'email_address']) }}
                    <span class="small-print">Only Account Directors/senior staff can confirm Internal Work Orders.</span>
                    {{ display_form_error('lead_unit_account_director', $errors) }}
                </div>
                <div class="formfield">
                    {{ Form::label('email_address', 'Email Address:', ['class' => 'required']) }}
                    {{ Form::text('email_address', Input::old('email_address'), ['id' => 'email_address']) }}
                    {{ display_form_error('email_address', $errors) }}
                </div>
            </div>
            <div class="formgroup">
                <div class="title">Sub-contracted Unit</div>
                <div class="formfield">
                    {{ Form::label('sub_contracted_unit_correspondent_affiliate', 'Sub-contracted Unit:', ['class' => 'required']) }}
                    {{ Form::text('sub_contracted_unit_correspondent_affiliate', Input::old('sub_contracted_unit_correspondent_affiliate')) }}
                    {{ display_form_error('sub_contracted_unit_correspondent_affiliate', $errors) }}
                </div>
                <div class="formfield">
                    {{ Form::label('sub_contracted_unit_correspondent_affiliate_account_director', 'Account Director responsible at the Sub-contracted Unit:', ['class' => 'required']) }}
                    {{ Form::text('sub_contracted_unit_correspondent_affiliate_account_director', Input::old('sub_contracted_unit_correspondent_affiliate_account_director'), ['data-email-field' => 'sub_email_address', 'class' => 'account_director_autocomplete']) }}
                    {{ display_form_error('sub_contracted_unit_correspondent_affiliate_account_director', $errors) }}
                </div>
                <div class="formfield">
                    {{ Form::label('sub_email_address', 'Email Address:', ['class' => 'required']) }}
                    {{ Form::text('sub_email_address', Input::old('sub_email_address')) }}
                    {{ display_form_error('sub_email_address', $errors) }}
                </div>
                <div class="formfield">
                    {{ Form::label('fipra_representative', 'Fipra Representative:', ['class' => 'required']) }}
                    {{ Form::text('fipra_representative', Input::old('fipra_representative')) }}
                    {{ display_form_error('fipra_representative', $errors) }}
                </div>
            </div>
            <div class="formgroup">
                <div class="title">Fees</div>
                <div class="formfield">
                    {{ Form::label('the_work_will_be_done', 'The work will be done', ['class' => 'required']) }}
                    {{ Form::select('the_work_will_be_done', ['' => 'Select one of the following...', 'at the standard Fipra hourly rates' => 'at the standard Fipra hourly rates', 'at a different Fipra hourly rate' => 'at a different Fipra hourly rate', 'at a day rate' => 'at a day rate', 'at a flat or project rate' => 'at a flat or project rate'], Input::old('the_work_will_be_done'), ['class' => 'inline', 'id' => 'the-work-will-be-done']) }}
                    <div class="help-box">
                        <table width="100%">
                            <tr>
                                <td>Account Directors and Senior Consultants</td>
                                <td>€425 per hour</td>
                            </tr>
                            <tr>
                                <td>Account Managers</td>
                                <td>€325 per hour</td>
                            </tr>
                            <tr>
                                <td>Account Executives</td>
                                <td>€225 per hour</td>
                            </tr>
                            <tr>
                                <td>Researchers</td>
                                <td>€125 per hour</td>
                            </tr>
                        </table>
                    </div>
                    <div class="fees-people sub-box">
                        {{ Form::label('', 'The following person(s) will work at these rates:') }}
                        <table width="100%">
                            <thead>
                                <td width="70%">Name</td>
                                <td width="20%" class="rate-label">Rate</td>
                                <td width="10%"></td>
                            </thead>
                            <tr class="fees-person">
                                <td>{{ Form::text('person', Input::old('person'), ['style' => 'width:90%']) }}</td>
                                <td><span class="inline">&euro;</span> {{ Form::text('rate', Input::old('rate'), ['style' => 'width:80%']) }}</td>
                                <td></td>
                            </tr>
                            <!--<tr class="fees-person-clone">-->
                            <!--    <td>{{ Form::text('person', Input::old('person'), ['style' => 'width:90%']) }}</td>-->
                            <!--    <td><span class="inline">&euro;</span> {{ Form::text('rate', Input::old('rate'), ['style' => 'width:80%']) }}</td>-->
                            <!--    <td><a class="secondary remove-row"><i class="fa fa-times fa-lg"></i></a></td>-->
                            <!--</tr>-->
                            <tr colspan="3">
                                <!--<td><a class="secondary add-new-person">Add new person</a></td>-->
                            </tr>
                        </table>
                    </div>
                    {{ display_form_error('the_work_will_be_done', $errors) }}

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
                <div class="formfield">
                    {{ Form::label('work_capped_each_month', 'Is this work capped at a maximum level each month?', ['class' => 'required']) }}
                    {{ Form::select('work_capped_each_month', ['No' => 'No', 'Yes' => 'Yes'], Input::old('work_capped_each_month'), ['class' => 'work-capped-each-month']) }}
                    {{ display_form_error('work_capped_each_month', $errors) }}
                </div>
                <div class="formfield hide" id="work-capped-each-month-reveal">
                    {{ Form::label('work_cap', 'What is the cap?') }}
                    {{ Form::text('work_cap', Input::old('work_cap')) }}
                    {{ display_form_error('work_cap', $errors) }}
                </div>
            </div> <!-- /formgroup -->
		</section>

		<section class="col-6 last">
            <div class="formfield">
                {{ Form::label('name_of_client', 'Name of client associated with the account:') }}
                {{ Form::text('name_of_client', Input::old('name_of_client')) }}
                {{ display_form_error('name_of_client', $errors) }}
            </div>
            <div class="formfield">
                {{ Form::label('project_name', 'Project name (if any):') }}
                {{ Form::text('project_name', Input::old('project_name')) }}
                {{ display_form_error('project_name', $errors) }}
            </div>
            <div class="formfield">
                {{ Form::label('replicon_code', 'Replicon code (only applicable to Fipra International):') }} <a href="#" class="help">&nbsp;</a>
                <div class="help-box">Replicon codes are Fipra's internal timesheet codes.</div>
                {{ Form::text('replicon_code', Input::old('replicon_code')) }}
                {{ display_form_error('replicon_code', $errors) }}
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
                <div class="help-box">Please enter the start date of the IWO. The Start date is from when payments can be made under this IWO.</div>
                {{ Form::text('time_frame', Input::old('time_frame')) }}
                {{ display_form_error('time_frame', $errors) }}
            </div>
            <div class="formfield">
                {{ Form::label('internal_work_order_expires', 'IWO expiry date:', ['class' => 'required']) }} <a href="#" class="help">&nbsp;</a>
                <div class="help-box">This is the date payment will stop under this IWO.</div>
                {{ Form::text('internal_work_order_expires', Input::old('internal_work_order_expires')) }}
                {{ display_form_error('internal_work_order_expires', $errors) }}
            </div>
			<div class="formfield">
				{{ Form::label('green_sheet_required', 'Is a Fipra Green Sheet required at the end of each month?', ['class' => 'required']) }} <a href="#" class="help">&nbsp;</a>
				<div class="help-box">Green Sheets are to be submitted within three working days of the end of the month in which the work has been performed. Green Sheets give details of the hours worked and are irrespective of the type of fee structure chosen above.</div>
				{{ Form::select('green_sheet_required', ['No' => 'No', 'Yes' => 'Yes'], Input::old('green_sheet_required'), ['class' => 'green-sheet-required']) }}
				{{ display_form_error('green_sheet_required', $errors) }}
			</div>
            <div class="formfield hide" id="green-sheet-required-reveal">
                <span class="small-print">Green Sheets are to be submitted within three working days of the end of the month in which the work has been performed. Green Sheets give details of the hours worked, irrespective of the type of fee structure chosen above. Please Click here to download a Greensheet template.</span>
            </div>
			<div class="formfield">
				{{ Form::label('other_information', 'Other information:') }}
				{{ Form::textarea('other_information', Input::old('other_information'), ['rows' => '10']) }}
				{{ display_form_error('other_information', $errors) }}
			</div>
		</section>

        <section class="col-12" style="clear:both">

			{{ display_submit_button('Next') }}


            <div class="grey-box">
                <div class="col-10 last">
                    <h4>Invoices</h4>
                    <p>Please note that the Lead Unit will not accept an invoice for more than the amount agreed in the Internal Work Order - without prior approval which may simply come in the form of an additional IWO.</p>
                    <p>We are aware that clients will sometimes contact you directly with requests for additional work that is not pre-authorised. Where this happens, please immediately contact the Account Director who will make changes to the budget where possible. Make the client aware you will need to do this as a matter of course.</p>

                    <h4>Caps</h4>
                    <p>Some fees have an agreed monthly maximum you may bill or “cap.” This is not the same as a fixed fee for the month. Generally invoices are expected to come in below the cap and any work above the cap cannot be invoiced without an IWO that raises the cap.</p>

                    <h4>High Value and Low Value work</h4>
                    <p>Fipra Units, as opposed to Special Advisers, are expected to have high and lower paid staff and apply the correct staffing for the appropriate level of work. No client will pay a top rate, usually reserved for strategic advice, for clerical work such as writing minutes. It is  therefore important that staff are correctly allocated and time/billing rates reflect this in line with the internal work order. Where no lower paid staff are available a lower rate must be charged for the higher grade staff doing less valuable work.</p>

                    <h4>The internal billing cycle is long, but you can help make it shorter</h4>
                    <p>As a matter of policy, Fipra generally requests payment from clients on 30-day terms. In practice clients often ignore this deadline or impose their own later payment terms. However, further delays can be avoided by Members sending in provisional bills, timesheets and invoices promptly or as early as possible, as a bill covering several Units cannot be ready until the slowest Member has sent theirs in to the Lead Unit for approval and processing.</p>

                    <h4>When should a Lead Unit pay out to subcontracting Members?</h4>
                    <p>All payments approved in the IWO system and by the Account Director concerned and therefore due to subcontracting Members of the Fipra Network are paid out by the Lead Unit  no later than within 10 working days of relevant payments having been received by the Lead Unit from the final client. A Unit providing work is under no obligation to automatically inform each subcontracting Unit every time a bill is paid. However in the event that a Member makes enquiries about payment of a bill, the Lead Unit’s Account Director has an obligation to inform the other Member of when clients made payments or, if known, when they are expected to do so.</p>

                    <h4>Non-payment or reduced-payments by clients</h4>
                    <p>Where there is an IWO,  the Lead Unit is responsible for paying each Member of the Fipra Network in respect of services provided to a client that have been agreed and approved. Once the relevant Account Director has accepted the timesheets of a subcontracting Unit, and relevant amounts billed by the Lead Unit, the Lead Unit will bear the risk of reduced payment, default or non-payment by the end client concerned. It will thus ensure that the subcontracting Member is paid in full, if necessary at the Lead Unit's own expense. This is in order to protect subcontracting Units from large-scale defaults and from the wrongdoing of another Unit that may cause a client not to pay. It also introduces a degree of financial discipline into the work passed between Units. That a client has refused to pay at all cannot be an excuse for internal non-payment.</p>

                    <p>However, in the rare event that a client does not pay invoices, or pays less than the amount invoiced, the Lead Unit may of course seek to negotiate a reduction with the fellow Member collegially, though the subcontracting Member will not be required to enter into such negotiation.</p>

                    <h4>Internal Work Orders</h4>

                    <p>Once agreed, copies of all completed online Internal Work Orders are sent promptly to Fipra’s finance department to enable the monitoring of Inter-Unit activities and to facilitate the Membership Review. Internal Work Orders are treated as confidential and are not disclosed to any person outside the Fipra finance department and the Fipra Representative for the Unit concerned. The Internal Work Orders serve to calculate the general turnover or the services performed between the Units of the Fipra Network. No Inter-Unit payment of any sort or for any work can take place without an Internal Work Order.</p>
                </div>
            </div>

            <p><a href="#top" class="back-to-top">back to top</a></p>

		</section>


	{{ Form::close() }}

	<script type="text/javascript" src="{{ asset('js/unitWorkOrder.js') }}"></script>
@stop