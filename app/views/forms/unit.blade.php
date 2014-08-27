@extends('layouts.master')

@section('nav_links')
    @if(editing())
        @include('manage.partials.editing_nav_links')
    @else
        <li><a href="/" class="highlight"><i class="fa fa-caret-left"></i> Back to IWO Menu</a></li>
    @endif
@stop

@section('content')

	<div class="intro">
        <p>This form confirms financial instructions between Members of the Fipra Network. Please fill one form out each time a Unit is subcontracted.</p>
        <p class="italic small-print">Please see full explanatory notes at the end of the page.</p>
        @if(editing())
            <p class="red">Fields in red cannot be edited.</p>
        @endif
	</div>

	@include('forms.partials.messages')

    @if(editing())
        {{ Form::open(['files' => true, 'url' => 'manage/confirmupdates']) }}
    @else
        {{ Form::open(['files' => true, 'url' => 'unit']) }}
    @endif

        @include('forms.partials.workorder_title_ref')

		<section class="col-6">

            <div class="formgroup">
                <div class="title">Lead Unit</div>

                <div class="formfield">
                    {{ Form::label('lead_unit', 'Lead Unit:', ['class' => 'required']) }} <a href="#" class="help">&nbsp;</a>
                    <div class="help-box">The Unit responsible for managing a particular client relationship or instruction, including with regard to financial arrangements with that client, where that client requires advice in more than one territory. It is the Lead Unit, and not the subcontracting Unit, that bears ultimate responsibility to the client for quality control.</div>

                    @if(editing())
                        {{ Form::text('lead_unit', $workorder->workorder->lead_unit, ['readonly' => 'readonly']) }}
                    @else
                        {{ Form::text('lead_unit', Input::old('lead_unit'), ['class' => 'unit_reps_autocomplete', 'data-rep-field' => 'lead_fipra_representative']) }}
                    @endif
                    {{ display_form_error('lead_unit', $errors) }}
                </div>

                <div class="formfield">
                    {{ Form::label('lead_unit_account_director', 'Account Director responsible at the Lead Unit:', ['class' => 'required']) }}

                    @if(editing())
                        {{ Form::text('lead_unit_account_director', $workorder->workorder->lead_unit_account_director, ['readonly' => 'readonly']) }}
                    @else
                        {{ Form::text('lead_unit_account_director', Input::old('lead_unit_account_director'), ['class' => 'account_director_autocomplete lead_unit_account_director', 'data-email-field' => 'lead_email_address']) }}
                    @endif

                    <span class="small-print">Only Account Directors/senior staff can confirm Internal Work Orders.</span>
                    {{ display_form_error('lead_unit_account_director', $errors) }}
                </div>

                <div class="formfield">
                    {{ Form::label('lead_email_address', 'Email Address:', ['class' => 'required']) }}

                    @if(editing())
                        {{ Form::text('lead_email_address', $workorder->workorder->lead_email_address, ['readonly' => 'readonly']) }}
                    @else
                        {{ Form::text('lead_email_address', Input::old('lead_email_address'), ['id' => 'lead_email_address']) }}
                    @endif

                    {{ display_form_error('lead_email_address', $errors) }}
                </div>

                <div class="formfield">
					{{ Form::label('lead_fipra_representative', 'Fipra Representative:', ['class' => 'required']) }}
					{{ Form::select('lead_fipra_representative', get_fipra_reps(), (editing()) ? $workorder->workorder->lead_fipra_representative : Input::old('lead_fipra_representative'), ['style' => 'width:100%']) }}
					{{ display_form_error('lead_fipra_representative', $errors) }}
				</div>

            </div>

            <div class="formgroup">
                <div class="title">Sub-contracted Unit</div>

                <div class="formfield">
                    {{ Form::label('sub_contracted_unit_correspondent_affiliate', 'Sub-contracted Unit:', ['class' => 'required']) }}

                    @if(editing())
                        {{ Form::text('sub_contracted_unit_correspondent_affiliate', $workorder->workorder->sub_contracted_unit_correspondent_affiliate, ['readonly' => 'readonly']) }}
                    @else
                        {{ Form::text('sub_contracted_unit_correspondent_affiliate', Input::old('sub_contracted_unit_correspondent_affiliate'), ['class' => 'unit_reps_autocomplete', 'data-rep-field' => 'sub_fipra_representative']) }}
                    @endif

                    {{ display_form_error('sub_contracted_unit_correspondent_affiliate', $errors) }}
                </div>

                <div class="formfield">
                    {{ Form::label('sub_contracted_unit_correspondent_affiliate_account_director', 'Account Director responsible at the Sub-contracted Unit:', ['class' => 'required']) }}
                    @if(editing())
                        {{ Form::text('sub_contracted_unit_correspondent_affiliate_account_director', $workorder->workorder->sub_contracted_unit_correspondent_affiliate_account_director, ['readonly' => 'readonly']) }}
                    @else
                        {{ Form::text('sub_contracted_unit_correspondent_affiliate_account_director', Input::old('sub_contracted_unit_correspondent_affiliate_account_director'), ['data-email-field' => 'sub_email_address', 'class' => 'account_director_autocomplete']) }}
                    @endif

                    {{ display_form_error('sub_contracted_unit_correspondent_affiliate_account_director', $errors) }}
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
                    {{ Form::label('sub_fipra_representative', 'Fipra Representative:', ['class' => 'required']) }}
                    {{ Form::select('sub_fipra_representative', get_fipra_reps(), (editing()) ? $workorder->workorder->sub_fipra_representative : Input::old('sub_fipra_representative'), ['style' => 'width:100%']) }}
                    {{ display_form_error('sub_fipra_representative', $errors) }}
                </div>
            </div>
            <div class="formgroup">
                <div class="title">Fees</div>
                <div class="formfield">
                    {{ Form::label('the_work_will_be_done', 'The work will be done', ['class' => 'required']) }}

                    {{ Form::select('the_work_will_be_done', ['' => 'Select one of the following...', 'at the standard Fipra hourly rates' => 'at the standard Fipra hourly rates', 'at a different Fipra hourly rate' => 'at a different Fipra hourly rate', 'at a flat or project rate' => 'at a flat or project rate'], (editing()) ? $workorder->workorder->the_work_will_be_done : Input::old('the_work_will_be_done'), ['class' => 'inline', 'id' => 'the-work-will-be-done']) }}
                    <div class="help-box">
                        <table width="100%" class="rate-table">
                        	<thead>
								<tr>
									<td></td>
									<td>Hourly Rate</td>
									<td>20% Discount</td>
								</tr>
                        	</thead>
                            <tr>
                                <td>Account Directors and Senior Consultants</td>
                                <td>€425</td>
                                <td>€340</td>
                            </tr>
                            <tr>
                                <td>Account Managers</td>
                                <td>€325</td>
                                <td>€260</td>
                            </tr>
                            <tr>
                                <td>Account Executives</td>
                                <td>€225</td>
                                <td>€180</td>
                            </tr>
                            <tr>
                                <td>Researchers</td>
                                <td>€125</td>
                                <td>€100</td>
                            </tr>
                        </table>
                    </div>

                    <div class="fees-people sub-box">
                        {{ Form::label('', 'The following person(s) will work at these rates:') }}
                        <table width="100%">
                            <thead>
                            <td width="60%">Name</td>
                            <td width="30%" class="rate-label">Rate</td>
                            <td width="10%"></td>
                            </thead>

                            <!--If this request is a failed validation or the user clicked 'go back' on the confirm page, load the old team member names and rate-->
                            @if(Input::old('team'))

                                @foreach(Input::old('team') as $id => $values)
                                    <tr class="fees-person">
                                        <td class="person-field">{{ Form::text("team[$id][person]", $values['person'], ['style' => 'width:90%']) }}</td>
                                        <td class="rate-field">
                                        	@if(Input::old('the_work_will_be_done') == 'at the standard Fipra hourly rates')
												<div class="fees-select">
													{{ Form::select("team[$id][rate]", ['340' => '€340', '260' => '€260', '180' => '€180', '100' => '€100'], $values['rate'], ['class' => 'inline']) }}
												</div>
												<div class="fees-text">
													<span class="inline">&euro;</span> {{ Form::text("team[$id][rate]", null, ['style' => 'width:80%']) }}
												</div>
                                        	@else
												<div class="fees-text">
													<span class="inline">&euro;</span> {{ Form::text("team[$id][rate]", $values['rate'], ['style' => 'width:80%']) }}
												</div>
												<div class="fees-select">
													{{ Form::select("team[$id][rate]", ['340' => '€340', '260' => '€260', '180' => '€180', '100' => '€100'], null, ['class' => 'inline']) }}
												</div>
                                        	@endif
                                        </td>
                                        <td><a class="secondary remove-row" href="#"><i class="fa fa-lg fa-times"></i></a></td>
                                    </tr>
                                @endforeach
                                {{ form::hidden('person_count', Input::old('person_count'), ['class' => 'person-count']) }}

                            <!--Otherwise, if this is an edit, use that data-->
                            @elseif(isset($workorder->workorder->team))
                                @foreach($workorder->workorder->team as $id => $values)
                                <tr class="fees-person">
                                    <td class="person-field">{{ Form::text("team[$id][person]", $values['person'], ['style' => 'width:90%']) }}</td>
                                    <td class="rate-field"><span class="inline">&euro;</span> {{ Form::text("team[$id][rate]", $values['rate'], ['style' => 'width:80%']) }}</td>
                                    <td><a class="secondary remove-row" href="#"><i class="fa fa-lg fa-times"></i></a></td>
                                </tr>
                                @endforeach
                                {{ form::hidden('person_count', Input::old('person_count'), ['class' => 'person-count']) }}

                            <!--Otherwise display the default entry form-->
                            @else
                                <tr class="fees-person">
                                    <td class="person-field">{{ Form::text('team[1][person]', null, ['style' => 'width:90%', 'class' => 'autofill']) }}</td>
                                    <td class="rate-field">
                                    	<div class="fees-text">
                                    		<span class="inline">&euro;</span> {{ Form::text('team[1][rate]', null, ['style' => 'width:80%']) }}
                                    	</div>
                                    	<div class="fees-select">
											{{ Form::select('team[1][rate]', ['340' => '€340', '260' => '€260', '180' => '€180', '100' => '€100'], ['class' => 'inline']) }}
										</div>
                                    </td>
                                    <td><a class="secondary remove-row" href="#"><i class="fa fa-lg fa-times"></i></a></td>
                                </tr>
                                {{ form::hidden('person_count', '1', ['class' => 'person-count']) }}
                            @endif


                            <tr colspan="3">
                                <td><a class="secondary add-new-person">Add new person</a></td>
                            </tr>
                        </table>
                    </div>
                    {{ display_form_error('the_work_will_be_done', $errors) }}

                </div>
                <div class="formfield">
                    {{ Form::label('agreed_fee_element', 'Is there any other fee element, such as a success or finders fee?', ['class' => 'required']) }}
                    {{ Form::select('agreed_fee_element', ['No' => 'No', 'Yes' => 'Yes'], (editing()) ? $workorder->workorder->agreed_fee_element : Input::old('agreed_fee_element'), ['class' => 'agreed-fee-element']) }}
                    {{ display_form_error('agreed_fee_element', $errors) }}
                </div>
                <div class="formfield hide" id="agreed-fee-element-reveal">
                    {{ Form::label('agreed_fee_element_details', 'Please set out fee element details:', ['class' => 'required']) }}
                    {{ Form::textarea('agreed_fee_element_details', (editing()) ? $workorder->workorder->agreed_fee_element_details : Input::old('agreed_fee_element_details'), ['rows' => '10']) }}
                    {{ display_form_error('agreed_fee_element_details', $errors) }}
                </div>
                <div class="formfield">
                    <div>All the fees above, except success/finders fee, will be invoiced with the 20% Fipra Inter-Unit discount, unless otherwise stated in the notes at the end of this form. <a href="#" class="help">&nbsp;</a>
                    <p class="help-box">When a Unit subcontracts to another Unit for work, a percentage known as the Inter-Unit discount is paid to the Unit that introduced the client work. Thus the Lead Unit receives an Inter-Unit discount on the net invoice amount billed to the client.</p></div>
                </div>
                <div class="formfield">
                    {{ Form::label('work_capped_each_month', 'Is this work capped at a maximum level each month?', ['class' => 'required']) }}
                    {{ Form::select('work_capped_each_month', ['No' => 'No', 'Yes' => 'Yes'], (editing()) ? $workorder->workorder->work_capped_each_month : Input::old('work_capped_each_month'), ['class' => 'work-capped-each-month']) }}
                    {{ display_form_error('work_capped_each_month', $errors) }}
                </div>
                <div class="formfield hide" id="work-capped-each-month-reveal">
                    {{ Form::label('work_cap', 'What is the cap (€)?') }}
                    {{ Form::text('work_cap', (editing()) ? $workorder->workorder->work_cap : Input::old('work_cap')) }}
                    {{ display_form_error('work_cap', $errors) }}
                </div>
            </div> <!-- /formgroup -->
		</section>

		<section class="col-6 last">
            <div class="formfield">
                {{ Form::label('name_of_client_company', 'Name of client company associated with the account:') }}
                {{ Form::text('name_of_client_company', (editing()) ? $workorder->workorder->name_of_client_company : Input::old('name_of_client_company')) }}
                {{ display_form_error('name_of_client_company', $errors) }}
            </div>
            <div class="formfield">
                {{ Form::label('project_name', 'Project name (if any):') }}
                {{ Form::text('project_name', (editing()) ? $workorder->workorder->project_name : Input::old('project_name')) }}
                {{ display_form_error('project_name', $errors) }}
            </div>
            <div class="formfield">
                {{ Form::label('replicon_code', 'Replicon code (only applicable to Fipra International):') }} <a href="#" class="help">&nbsp;</a>
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
                <p class="small-print">An email will be sent to you 10 days before this work order expires.</p>
            </div>
			<div class="formfield">
				{{ Form::label('green_sheet_required', 'Is a Fipra Green Sheet required at the end of each month?', ['class' => 'required']) }} <a href="#" class="help">&nbsp;</a>
				<div class="help-box">Green Sheets are to be submitted within three working days of the end of the month in which the work has been performed. Green Sheets give details of the hours worked and are irrespective of the type of fee structure chosen above.</div>
				{{ Form::select('green_sheet_required', ['No' => 'No', 'Yes' => 'Yes'], (editing()) ? $workorder->workorder->green_sheet_required : Input::old('green_sheet_required'), ['class' => 'green-sheet-required']) }}
				{{ display_form_error('green_sheet_required', $errors) }}
			</div>
            <div class="formfield hide" id="green-sheet-required-reveal">
				@include('forms.partials.green_sheet_links')
                <span class="small-print">Green Sheets are to be submitted within three working days of the end of the month in which the work has been performed. Green Sheets give details of the hours worked, irrespective of the type of fee structure chosen above. Please Click here to download a Greensheet template.</span>
            </div>


			<div class="formfield">
				{{ Form::label('other_information', 'Any other relevant information including variants on terms:') }}
				{{ Form::textarea('other_information', (editing()) ? $workorder->workorder->other_information : Input::old('other_information'), ['rows' => '10']) }}
				{{ display_form_error('other_information', $errors) }}
			</div>
		</section>

		@include('forms.partials.copy_emails')

        <section class="col-12" style="clear:both">

			{{ display_submit_button('Next') }}


            <div class="grey-box">
                <div class="col-10 last">
                    <h4>Invoices</h4>
                    <p>Please note that the Lead Unit will not accept an invoice for more than the amount agreed in the Internal Work Order, without prior approval by both sides.</p>
                    <p>We are aware that clients may sometimes contact you directly with requests for additional work that is not pre-authorised. Where this happens, please immediately contact the Account Director who will make changes to the budget where possible. Please make the client aware you will need to do this as a matter of course.</p>

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

	<script type="text/javascript" src="{{ asset('js/unitWorkOrder.js?140826') }}"></script>
@stop