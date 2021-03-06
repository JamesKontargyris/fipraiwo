@extends('layouts.master')

@section('nav_links')
    <li><a href="/" class="highlight"><i class="fa fa-caret-left"></i> Back to IWO Menu</a></li>
@stop

@section('content')
    <div class="intro">
        <p>Submitting and agreeing an IWO, constitutes a binding contractual agreement. As such IWOs should only be
            submitted by, or on instruction of, Account Director level Fipriots.</p>
        <p>This form confirms instructions between FIPRA International and its Special Advisors, who are full members of
            the FIPRA Network. Please fill one out each time you engage a Special Advisor.</p>
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
                {{ Form::label('special_adviser_instructed', 'Special Advisor instructed:', ['class' => 'required']) }}
                @if(editing())
                    {{ Form::text('special_adviser_instructed', isset($workorder->workorder->special_adviser_instructed) ? $workorder->workorder->special_adviser_instructed : '', ['class' => 'spad_reps_autocomplete', 'data-rep-field' => 'sub_fipra_representative', 'readonly' => 'readonly']) }}
                @else
                    {{ Form::text('special_adviser_instructed', Input::old('special_adviser_instructed'), ['class' => 'spad_reps_autocomplete', 'data-rep-field' => 'sub_fipra_representative', 'data-email-field' => 'sub_email_address']) }}
                @endif
                {{ display_form_error('special_adviser_instructed', $errors) }}
            </div>
            <div class="formfield">
                {{ Form::label('sub_email_address', 'Special Advisor Email Address:', ['class' => 'required']) }}
                @if(editing())
                    {{ Form::text('sub_email_address', isset($workorder->workorder->sub_email_address) ? $workorder->workorder->sub_email_address : '', ($loggedin_user->hasRole('Lead') || $loggedin_user->hasRole('SuperUser')) ? [] : ['readonly' => 'readonly']) }}
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
                <span class="small-print">No Unit other than FIPRA International can submit an Internal Work Order for a Special Advisor.</span>
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
                {{ Form::label('billing_entity', 'FIPRA Billing Entity:', ['class' => 'required']) }}
                @if(editing())
                    {{ Form::text('billing_entity', isset($workorder->workorder->billing_entity) ? $workorder->workorder->billing_entity : '', ['style' => 'width:100%', 'readonly' => 'readonly']) }}
                @else
                    {{ Form::select('billing_entity', ['' => 'Please select...', 'FIPRA International BE (full member)' => 'FIPRA International BE', 'FIPRA International UK (full member)' => 'FIPRA International UK'], Input::old('billing_entity'), ['style' => 'width:100%', 'class' => 'billing_entity', 'data-additional-info-field' => 'billing_unit_additional_info']) }}
                @endif
                {{ display_form_error('billing_entity', $errors) }}
            </div>

            <div class="formfield formfield--unit-additional-info">
                {{ Form::label('billing_unit_additional_info', 'Additional info:') }}
                {{ Form::textarea('billing_unit_additional_info', isset($workorder->workorder->billing_unit_additional_info) ? $workorder->workorder->billing_unit_additional_info : 'None', ['rows' => 6, 'readonly' => 'readonly']) }}
            </div>

            <div class="formfield">
                {{ Form::label('sub_fipra_representative', 'FIPRA Representative:', ['class' => 'required']) }}
                @if(editing())
                    {{ Form::text('sub_fipra_representative', isset($workorder->workorder->sub_fipra_representative) ? $workorder->workorder->sub_fipra_representative : '', ['style' => 'width:100%', 'readonly' => 'readonly']) }}
                @else
                    {{ Form::select('sub_fipra_representative', get_fipra_reps(), Input::old('sub_fipra_representative'), ['style' => 'width:100%']) }}
                @endif
                {{ display_form_error('sub_fipra_representative', $errors) }}
            </div>
        </div>

        <div class="formgroup">
            <div class="title">Fees</div>

            @if(isset($workorder->workorder->the_work_will_be_done) || Input::old('the_work_will_be_done'))

                <div class="formfield">
                    {{ Form::label('the_work_will_be_done', 'The work will be done', ['class' => 'required']) }}
                    {{ Form::select('the_work_will_be_done', ['' => 'Select one of the following...', 'at the standard FIPRA hourly rate' => 'at the standard FIPRA hourly rate', 'at a different FIPRA hourly rate' => 'at a different FIPRA hourly rate', 'at a daily rate' => 'at a daily rate', 'at a flat or project rate' => 'at a flat or project rate'], (editing()) ? isset($workorder->workorder->the_work_will_be_done) ? $workorder->workorder->the_work_will_be_done : '' : Input::old('the_work_will_be_done'), ['class' => 'inline', 'id' => 'the-work-will-be-done']) }}

                    <div class="sub-box rate-field col-12">
                        {{ Form::label('rate_is', 'Rate:', ['class' => 'required rate-label']) }}
                        <span class="inline bold"><br/>&euro;</span> {{ Form::text('rate_is', (editing()) ? isset($workorder->workorder->rate_is) ? $workorder->workorder->rate_is : '' : Input::old('rate_is'), ['class' => 'inline-field']) }}
                        {{ display_form_error('rate_is', $errors) }}<br/><br/>

                        {{ Form::label('amount_payable', 'Amount payable:', ['class' => 'required']) }}
                        <span class="inline bold"><br/>&euro;</span> {{ Form::text('amount_payable', (editing()) ? isset($workorder->workorder->amount_payable) ? $workorder->workorder->amount_payable : '' : Input::old('amount_payable'), ['class' => 'inline-field']) }}
                        {{ display_form_error('amount_payable', $errors) }}

                    </div>
                    {{ display_form_error('the_work_will_be_done', $errors) }}

                </div>

            @else

                <div class="formfield">

                    @include('partials.field_rate_type')

                </div>

                <div class="formfield fee-days">
                    {{ Form::label('day_rate_in_euros', 'Day rate in Euros:', ['class' => 'required']) }}
                    @if(editing())
                        {{ Form::text('day_rate_in_euros', isset($workorder->workorder->day_rate_in_euros) ? $workorder->workorder->day_rate_in_euros : '', ['style' => 'width:30%', 'class' => 'day_rate']) }}
                    @else
                        {{ Form::text('day_rate_in_euros', Input::old('day_rate_in_euros'), ['style' => 'width:30%', 'class' => 'day_rate']) }}
                    @endif
                    <br><span class="small-print">Day rates for SPADs can vary, please make sure to check the applicable rate before submitting an order.</span>
                    {{ display_form_error('day_rate_in_euros', $errors) }}<br><br>

                    {{ Form::label('days', 'No. of days:', ['class' => 'required']) }}
                    @if(editing())
                        {{ Form::text('days', isset($workorder->workorder->days) ? $workorder->workorder->days : '', ['style' => 'width:30%', 'class' => 'no_of_days']) }}
                    @else
                        {{ Form::text('days', Input::old('days'), ['style' => 'width:30%', 'class' => 'no_of_days']) }}
                    @endif
                    <div>@include('partials.days-help-message')</div>
                    {{ display_form_error('days', $errors) }}

                    <div style="padding:18px 0 6px 0; font-size:16px; font-weight:bold;" class="grand-total">Total: €0
                    </div>
                    {{--                        {{ Form::hidden('day_rate_in_euros', 2000, ['class' => 'day_rate']) }}--}}
                    {{ Form::hidden('total_in_euros', Input::old('total_in_euros'), ['class' => 'day_rate_total']) }}
                </div>

                <div class="formfield fee-monthlyrate">
                    {{ Form::label('monthly_rate_in_euros', 'Rate:', ['class' => 'required']) }}
                    @if(editing())
                    &euro;
                    {{ Form::text('monthly_rate_in_euros', isset($workorder->workorder->monthly_rate_in_euros) ? $workorder->workorder->monthly_rate_in_euros : '', ['style' => 'width:30%']) }}
                    @else
                    &euro; {{ Form::text('monthly_rate_in_euros', Input::old('monthly_rate_in_euros'), ['style' => 'width:30%']) }}
                    @endif
                    {{ display_form_error('monthly_rate_in_euros', $errors, ['class' => 'monthly_rate']) }}
                </div>

                <div class="formfield fee-flatrate">
                    {{ Form::label('flat_rate_in_euros', 'Rate:', ['class' => 'required']) }}
                    @if(editing())
                    &euro;
                    {{ Form::text('flat_rate_in_euros', isset($workorder->workorder->flat_rate_in_euros) ? $workorder->workorder->flat_rate_in_euros : '', ['style' => 'width:30%']) }}
                    @else
                    &euro; {{ Form::text('flat_rate_in_euros', Input::old('flat_rate_in_euros'), ['style' => 'width:30%']) }}
                    @endif
                    {{ display_form_error('flat_rate_in_euros', $errors, ['class' => 'flat_rate']) }}
                </div>

            @endif


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
                {{ Form::text('work_cap', (editing()) ? isset($workorder->workorder->work_cap) ? $workorder->workorder->work_cap : '' : Input::old('work_cap'), ['class' => 'inline-field']) }}
                {{ Form::select('work_cap_currency', ['EUR' => 'EUR €', 'USD' => 'USD $', 'GBP' => 'GBP £'], (editing()) ? isset($workorder->workorder->work_cap_currency) ? $workorder->workorder->work_cap_currency : '' : Input::old('work_cap_currency'), ['style' => 'float:left'])}}
                {{ Form::select('work_cap_period', ['Per month' => 'per month', 'Per day' => 'per day', 'for the duration of the IWO' => 'For the duration of the IWO'], (editing()) ? isset($workorder->workorder->work_cap_period) ? $workorder->workorder->work_cap_period : '' : Input::old('work_cap_period'), ['class' => 'work-cap-period']) }}
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
            <div class="help-box">Replicon codes are FIPRA's internal timesheet codes.</div>
            {{ Form::text('replicon_code', (editing()) ? isset($workorder->workorder->replicon_code) ? $workorder->workorder->replicon_code : '' : Input::old('replicon_code')) }}
            {{ display_form_error('replicon_code', $errors) }}
        </div>
        <div class="formfield">
            {{ Form::label('scope_of_service', 'Scope of Service:', ['class' => 'required']) }} <a href="#"
                                                                                                   class="help">&nbsp;</a>
            <div class="help-box">Set out a description of the services to be performed in reasonable detail.</div>
            {{ Form::textarea('scope_of_service', (editing()) ? isset($workorder->workorder->scope_of_service) ? $workorder->workorder->scope_of_service : '' : Input::old('scope_of_service'), ['rows' => '5']) }}
            {{ display_form_error('scope_of_service', $errors) }}
        </div>
        <div class="formfield">
            {{ Form::label('deliverables', 'Deliverables:', ['class' => 'required']) }} <a href="#"
                                                                                           class="help">&nbsp;</a>
            <div class="help-box">Set out the nature of any deliverables in reasonable detail.</div>
            {{ Form::textarea('deliverables', (editing()) ? isset($workorder->workorder->deliverables) ? $workorder->workorder->deliverables : '' : Input::old('deliverables'), ['rows' => '5']) }}
            {{ display_form_error('deliverables', $errors) }}
        </div>
        <div class="formfield">
            {{ Form::label('internal_work_order_start_date', 'IWO start date:', ['class' => 'required']) }} <a href="#"
                                                                                                               class="help">&nbsp;</a>
            <div class="help-box">The Start date is from when payments can be made under this IWO.</div>
            {{ Form::text('internal_work_order_start_date', (editing()) ? isset($workorder->workorder->internal_work_order_start_date) ? $workorder->workorder->internal_work_order_start_date : '' : Input::old('internal_work_order_start_date'), ['class' => 'datepicker', 'id' => 'internal_work_order_start_date_datepicker']) }}
            {{ display_form_error('internal_work_order_start_date', $errors) }}
        </div>
        <div class="formfield">
            {{ Form::label('internal_work_order_expiry_date', 'IWO expiry date:', ['class' => 'required']) }} <a
                    href="#" class="help">&nbsp;</a>
            <div class="help-box">This is the date payment will stop under this IWO.</div>
            {{ Form::text('internal_work_order_expiry_date', (editing()) ? isset($workorder->workorder->internal_work_order_expiry_date) ? $workorder->workorder->internal_work_order_expiry_date : '' : Input::old('internal_work_order_expiry_date'), ['class' => 'datepicker', 'id' => 'internal_work_order_expiry_date_datepicker']) }}
            {{ display_form_error('internal_work_order_expiry_date', $errors) }}
        </div>

        <div class="formfield">
            {{ Form::label('green_sheet_required', 'Is a FIPRA Green Sheet required at the end of each month?', ['class' => 'required']) }}
            <a href="#" class="help">&nbsp;</a>
            <div class="help-box">Green Sheets are to be submitted within three working days of the end of the month in
                which the work has been performed. Green Sheets give details of the days, quarter days - and in rare
                cases hours (where a client needs this information) worked and are irrespective of the type of fee
                structure chosen or the fee agreed above. Such time sheets are only needed for billing purposes.
            </div>
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

                <h4>Engaging Special Advisors / other external advisers</h4>
                <p>Where a Lead Unit that has contracted a client requires the services of a Special Advisor, all
                    agreements with that Special Advisor, including Internal Work Orders and invoicing, must be made
                    through FIPRA International. Special Advisors are individuals (as opposed to Units that are
                    typically companies with staff). As most are very senior or retired persons this rule gives each
                    Special Advisor just one billing and instruction point, making administration easier and more
                    streamlined.</p>

                <h4>The internal billing cycle is long, but you can help make it shorter</h4>
                <p>As a matter of policy, FIPRA generally requests payment from clients on 30-day terms. In practice
                    clients often ignore this deadline or impose their own later payment terms. However, further delays
                    can be avoided - by all Members sending in Internal Work Orders, provisional bills, timesheets and
                    invoices as promptly as possible. A bill covering several Units cannot be ready until the slowest
                    Member has sent theirs in to the Lead Unit for approval and processing.</p>

                <h4>When will FIPRA International pay you?</h4>
                <p>All payments are made no later than within 10 working days of the relevant payment having been
                    received by FIPRA International from the final client. If a Member asks, the Account Director has an
                    obligation to inform the other Member of when clients made payments or, if known, when they are
                    expected to do so. However FIPRA International will not automatically inform members when each
                    payment is received by us.</p>

                <h4>Non-payment or reduced-payments by clients</h4>
                <p>FIPRA International is responsible for paying each Special Advisor in respect of services provided to
                    a client that have been agreed and approved. Once the timesheets of a subcontracting Special Advisor
                    have been accepted by the relevant Account Director, and relevant amounts billed to the client by
                    FIPRA, FIPRA will bear the risk of reduced payment, default or non-payment by the end client
                    concerned. It will thus ensure that the subcontracting Member is paid in full, if necessary at FIPRA
                    International’s own expense. That a client has refused to pay at all cannot be an excuse for
                    internal non-payment.</p>

                <p>However, in the rare event that a client does not pay invoices, or pays less than the amount
                    invoiced, FIPRA International may of course seek to negotiate a reduction with the fellow Member
                    collegially, though the Special Advisor will not be required to enter into such negotiation.</p>

                <h4>Internal Work Orders</h4>
                <p>Once agreed, copies of all completed online Internal Work Orders are sent promptly to FIPRA’s finance
                    department to enable the monitoring of Inter-Unit activities and to facilitate the Membership
                    Review. Internal Work Orders are treated as confidential and are not disclosed to any person outside
                    the FIPRA finance department with exception of the FIPRA Representative, the person at FIPRA who has
                    the key relationship with the Special Advisor concerned. Internal Work Orders also serve to
                    calculate the general turnover or the services performed between the Units of the FIPRA Network.</p>

                <p>Remember, no payment of any sort or for any work can take place without an Internal Work Order.</p>

            </div>
        </div>

        <p><a href="#top" class="back-to-top">back to top</a></p>

    </section>


    {{ Form::close() }}

@stop

@section('footer')
    @if(Input::has('the_work_will_be_done') || isset($workorder->workorder->the_work_will_be_done))
        {{--If this IWO uses the old style fees model, load the necessary JS--}}
        <script type="text/javascript" src="{{ asset('js/old_fees_spad.js?160430') }}"></script>
    @else
        {{--Otherwise, use the JS relevant to the new style fees model--}}
        <script type="text/javascript" src="{{ asset('js/new_fees_spad.js?160430') }}"></script>
    @endif
@stop