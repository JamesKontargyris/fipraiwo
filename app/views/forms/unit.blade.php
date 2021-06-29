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
        <p>Submitting and agreeing an IWO, constitutes a binding contractual agreement. As such IWOs should only be
            submitted by, or on instruction of, Account Director level Fipriots.</p>
        <p>This form confirms financial instructions given by Members of the FIPRA Network to other Members. Please fill
            one form out each time a Member is subcontracted. Please do not use the form below for Special Advisors or
            any other membership category.</p>
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
            <div class="title">Lead Unit / Representative</div>

            <div class="formfield">
                {{ Form::label('lead_unit', 'Lead Member / Country Representative:', ['class' => 'required']) }} <a
                        href="#" class="help">&nbsp;</a>
                <div class="help-box">The Member responsible for managing a particular client relationship or
                    instruction, including with regard to financial arrangements with that client, where that client
                    requires advice in more than one territory. It is the Lead Member, and not the subcontracting
                    Member, that bears ultimate responsibility to the client for quality control.
                </div>

                @if(editing())
                    {{ Form::text('lead_unit', isset($workorder->workorder->lead_unit) ? $workorder->workorder->lead_unit : '', ['readonly' => 'readonly']) }}
                @else
                    {{ Form::text('lead_unit', Input::old('lead_unit'), ['class' => 'unit_lead_contact_rep_autocomplete', 'data-name-field' => 'lead_unit_account_director', 'data-email-field' => 'lead_email_address', 'data-rep-field' => 'lead_fipra_representative', 'data-additional-info-field' => 'lead_unit_additional_info']) }}
                @endif
                {{ display_form_error('lead_unit', $errors) }}
            </div>

            <div class="formfield">
                {{ Form::label('lead_unit_account_director', 'Account Director responsible at the Lead Member / Country Representative:', ['class' => 'required']) }}

                @if(editing())
                    {{ Form::text('lead_unit_account_director', isset($workorder->workorder->lead_unit_account_director) ? $workorder->workorder->lead_unit_account_director : '', ( ! $loggedin_user->hasRole('SuperUser') ? ['readonly' => 'readonly'] : [])) }}
                @else
                    {{ Form::text('lead_unit_account_director', Input::old('lead_unit_account_director'), ['class' => 'account_director_autocomplete lead_unit_account_director', 'data-email-field' => 'lead_email_address']) }}
                @endif

                <span class="small-print">Only Account Directors/senior staff can confirm Internal Work Orders.</span>
                {{ display_form_error('lead_unit_account_director', $errors) }}
            </div>

            <div class="formfield">
                {{ Form::label('lead_email_address', 'Email Address:', ['class' => 'required']) }}

                @if(editing())
                    {{ Form::text('lead_email_address', isset($workorder->workorder->lead_email_address) ? $workorder->workorder->lead_email_address : '', ( ! $loggedin_user->hasRole('SuperUser') ? ['readonly' => 'readonly'] : [])) }}
                @else
                    {{ Form::text('lead_email_address', Input::old('lead_email_address'), ['id' => 'lead_email_address']) }}
                @endif

                {{ display_form_error('lead_email_address', $errors) }}
            </div>

            <div class="formfield">
                {{ Form::label('lead_fipra_representative', 'FIPRA Representative:', ['class' => 'required']) }}
                @if(editing())
                    {{ Form::text('lead_fipra_representative', isset($workorder->workorder->lead_fipra_representative) ? $workorder->workorder->lead_fipra_representative : '', ['readonly' => 'readonly']) }}
                @else
                    {{ Form::select('lead_fipra_representative', get_fipra_reps(), Input::old('lead_fipra_representative'), ['style' => 'width:100%']) }}
                @endif
                {{ display_form_error('lead_fipra_representative', $errors) }}
            </div>

            <div class="formfield formfield--unit-additional-info">
                {{ Form::label('lead_unit_additional_info', 'Additional info:') }}
                {{ Form::textarea('lead_unit_additional_info', isset($workorder->workorder->lead_unit_additional_info) ? $workorder->workorder->lead_unit_additional_info : 'None', ['rows' => 6, 'readonly' => 'readonly']) }}
            </div>

        </div>

        <div class="formgroup">
            <div class="title">Sub-contracted Member / Representative</div>

            {{--<div class="formfield">--}}
            {{--{{ Form::label('sub_contracted_unit_correspondent_affiliate', 'Sub-contracted Unit:', ['class' => 'required']) }}--}}

            {{--@if(editing())--}}
            {{--{{ Form::text('sub_contracted_unit_correspondent_affiliate', isset($workorder->workorder->sub_contracted_unit_correspondent_affiliate) ? $workorder->workorder->sub_contracted_unit_correspondent_affiliate : '', ['readonly' => 'readonly']) }}--}}
            {{--@else--}}
            {{--{{ Form::text('sub_contracted_unit_correspondent_affiliate', Input::old('sub_contracted_unit_correspondent_affiliate'), ['class' => 'unit_lead_contact_rep_autocomplete', 'data-name-field' => 'sub_contracted_unit_correspondent_affiliate_account_director', 'data-email-field' => 'sub_email_address', 'data-rep-field' => 'sub_fipra_representative', 'data-rate-band-field' => 'rate_band']) }}--}}
            {{--@endif--}}

            {{--{{ display_form_error('sub_contracted_unit_correspondent_affiliate', $errors) }}--}}
            {{--</div>--}}

            <div class="formfield">
                {{ Form::label('sub_contracted_unit_correspondent_affiliate', 'Sub-contracted Member / Country Representative:', ['class' => 'required']) }}

                @if(editing())
                    {{ Form::text('sub_contracted_unit_correspondent_affiliate', isset($workorder->workorder->sub_contracted_unit_correspondent_affiliate) ? $workorder->workorder->sub_contracted_unit_correspondent_affiliate : '', ['readonly' => 'readonly']) }}
                @else
                    {{ Form::select('sub_contracted_unit_correspondent_affiliate', get_all_units_for_dropdown(), Input::old('sub_contracted_unit_correspondent_affiliate'), ['style' => 'width:100%', 'data-name-field' => 'sub_contracted_unit_correspondent_affiliate_account_director', 'data-email-field' => 'sub_email_address', 'data-rep-field' => 'sub_fipra_representative', 'data-rate-band-field' => 'rate_band', 'data-additional-info-field' => 'sub_unit_additional_info']) }}
                @endif

                {{ display_form_error('sub_contracted_unit_correspondent_affiliate', $errors) }}
            </div>

            <div class="formfield">
                {{ Form::label('sub_contracted_unit_correspondent_affiliate_account_director', 'Account Director responsible at the Sub-contracted Member / Country Representative:', ['class' => 'required']) }}
                @if(editing())
                    {{ Form::text('sub_contracted_unit_correspondent_affiliate_account_director', isset($workorder->workorder->sub_contracted_unit_correspondent_affiliate_account_director) ? $workorder->workorder->sub_contracted_unit_correspondent_affiliate_account_director : '', ($loggedin_user->hasRole('Lead') || $loggedin_user->hasRole('SuperUser')) ? [] : ['readonly' => 'readonly']) }}
                @else
                    {{ Form::text('sub_contracted_unit_correspondent_affiliate_account_director', Input::old('sub_contracted_unit_correspondent_affiliate_account_director'), ['data-email-field' => 'sub_email_address', 'class' => 'account_director_autocomplete sub_contracted_unit_correspondent_affiliate_account_director']) }}
                @endif

                {{ display_form_error('sub_contracted_unit_correspondent_affiliate_account_director', $errors) }}
            </div>

            <div class="formfield">
                {{ Form::label('sub_email_address', 'Email Address:', ['class' => 'required']) }}
                @if(editing())
                    {{ Form::text('sub_email_address', isset($workorder->workorder->sub_email_address) ? $workorder->workorder->sub_email_address : '', ($loggedin_user->hasRole('Lead') || $loggedin_user->hasRole('SuperUser')) ? [] : ['readonly' => 'readonly']) }}
                @else
                    {{ Form::text('sub_email_address', Input::old('sub_email_address')) }}
                @endif
                {{ display_form_error('sub_email_address', $errors) }}
            </div>

            <div class="formfield">
                {{ Form::label('sub_fipra_representative', 'FIPRA Representative:', ['class' => 'required']) }}
                @if(editing())
                    {{ Form::text('sub_fipra_representative', isset($workorder->workorder->sub_fipra_representative) ? $workorder->workorder->sub_fipra_representative : '', ['readonly' => 'readonly']) }}
                @else
                    {{ Form::select('sub_fipra_representative', get_fipra_reps(), Input::old('sub_fipra_representative'), ['style' => 'width:100%']) }}
                @endif
                {{ display_form_error('sub_fipra_representative', $errors) }}
            </div>

            <div class="formfield formfield--unit-additional-info">
                {{ Form::label('sub_unit_additional_info', 'Additional info:') }}
                {{ Form::textarea('sub_unit_additional_info', isset($workorder->workorder->sub_unit_additional_info) ? $workorder->workorder->sub_unit_additional_info : 'None', ['rows' => 6, 'readonly' => 'readonly']) }}
            </div>
        </div>


        <div class="formgroup">
            <div class="title">Fees</div>

            {{--If the old fees model was submitted, use this fees layout--}}
            @if(Input::old('team') && array_key_exists('the_work_will_be_done', Input::old()))
                <div class="formfield">
                    {{ Form::label('the_work_will_be_done', 'The work will be done', ['class' => 'required']) }}

                    {{ Form::select('the_work_will_be_done', ['' => 'Select one of the following...', 'at the standard FIPRA hourly rates' => 'at the standard FIPRA hourly rates', 'at a different FIPRA hourly rate' => 'at a different FIPRA hourly rate', 'at a daily rate' => 'at a daily rate', 'at a flat or project rate' => 'at a flat or project rate'], (editing()) ? isset($workorder->workorder->the_work_will_be_done) ? $workorder->workorder->the_work_will_be_done : '' : Input::old('the_work_will_be_done'), ['class' => 'inline', 'id' => 'the-work-will-be-done']) }}

                    @include('partials.old_fipraratestable')

                    <div class="fees-people sub-box">
                        {{ Form::label('', 'The following person(s) will work at these rates:') }}
                        <table width="100%">
                            <thead>
                            <td width="60%" class="bold">Name</td>
                            <td width="30%" class="rate-label bold">Rate</td>
                            <td width="10%"></td>
                            </thead>

                            @foreach(Input::old('team') as $id => $values)
                                <tr class="fees-person">
                                    <td class="person-field">{{ Form::text("team[$id][person]", $values['person'], ['style' => 'width:90%']) }}</td>
                                    <td class="rate-field">
                                        @if(Input::old('the_work_will_be_done') == 'at the standard FIPRA hourly rates')
                                            <div class="fees-select">
                                                {{ Form::select("team[$id][rate]", ['425' => '€425', '325' => '€325', '225' => '€225', '125' => '€125', 'N/A' => 'N/A'], isset($values['rate']) ? $values['rate'] : null, ['class' => 'inline']) }}
                                            </div>
                                            <div class="fees-text">
                                                <span class="inline bold">&euro;</span> {{ Form::text("team[$id][rate]", null, ['class' => 'inline-field']) }}
                                            </div>
                                        @else
                                            <div class="fees-text">
                                                <span class="inline bold">&euro;</span> {{ Form::text("team[$id][rate]", isset($values['rate']) ? $values['rate'] : null, ['class' => 'inline-field']) }}
                                            </div>
                                            <div class="fees-select">
                                                {{ Form::select("team[$id][rate]", ['425' => '€425', '325' => '€325', '225' => '€225', '125' => '€125', 'N/A' => 'N/A'], null, ['class' => 'inline']) }}
                                            </div>
                                        @endif
                                    </td>
                                    <td><a class="secondary remove-row" href="#"><i class="fa fa-lg fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                        {{ form::hidden('person_count', '1', ['class' => 'person-count']) }}
                        <a class="secondary add-new-person">Add new person</a>

                        <div class="total-project-fee">
                            {{ Form::label('', 'Total project fee:') }}
                            <span class="inline bold"><br/>&euro;</span> {{ Form::text("total_project_fee", (editing()) ? isset($workorder->workorder->total_project_fee) ? $workorder->workorder->total_project_fee : null : Input::old('total_project_fee'), ['class' => 'inline-field']) }}
                        </div>
                    </div>

                    {{ display_form_error('the_work_will_be_done', $errors) }}
                </div>



                {{--If the new fees model was submitted, use this fees layout--}}
            @elseif(Input::old('team') && ! array_key_exists('the_work_will_be_done', Input::old()))

                @include('partials.field_rate_band')

                <div class="formfield">

                    @include('partials.field_rate_type')

                    <div class="fees-people sub-box">
                        {{ Form::label('', 'The following person(s) will work at these rates:') }}<br>

                        @foreach(Input::old('team') as $id => $values)
                            <table width="100%" class="fees-person"
                                   style="background-color:#efefef; margin-bottom:10px;">
                                <tr>
                                    <td style="padding:6px 10px;" class="person-field">
                                        {{ Form::label('', 'Name', ['class' => 'required']) }}<br>
                                        {{ Form::text("team[$id][person]", $values['person'], ['class' => 'autofill inline-field']) }}
                                    </td>
                                    <td><a class="secondary remove-row" href="#"><i class="fa fa-lg fa-times"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:6px 10px;" colspan="2">
                                        {{ Form::label('', 'Level of Seniority', ['class' => 'required']) }}<br>
                                        <div class="level-select">
                                            {{ Form::select("team[$id][level]", ['account_director' => 'Heads of Network Members / Directors / Partners', 'account_manager' => 'Account Directors / Account Managers', 'account_executive' => 'Account Executives / other junior employees'], isset($values['level']) ? $values['level'] : null, ['class' => 'inline']) }}
                                        </div>
                                    </td>
                                </tr>
                                <tr class="rate-type-days">
                                    <td style="padding:6px 10px;">
                                        {{ Form::label('', 'No. of Days', ['class' => 'required']) }}<br>
                                        <div class="days-text-input" style="width:50%">
                                            {{ Form::text("team[$id][days]", $values['days'], ['class' => 'inline-field', 'width' => '10']) }}
                                            <br>{{ Form::checkbox("team[$id][per-month]", isset($values['per-month']) ? $values['per-month'] : '') }}
                                            Per month
                                        </div>
                                    </td>
                                </tr>
                                <tr class="rate-type-days">
                                    <td colspan="3"
                                        style="padding:6px 10px;">@include('partials.days-help-message')</td>
                                </tr>
                                <tr class="rate-type-monthly-rate">
                                    <td style="padding:6px 10px;">{{ Form::label('', 'Rate', ['class' => 'required']) }}</td>
                                    <td style="padding:6px 10px;">
                                        <div class="monthly-rate-text-input">
                                            &euro; {{ Form::text("team[$id][monthlyrate]", $values['monthlyrate'], ['class' => 'inline-field', 'width' => '10']) }}
                                        </div>
                                    </td>
                                </tr>
                                <tr class="rate-type-flat-rate">
                                    <td style="padding:6px 10px;">{{ Form::label('', 'Rate', ['class' => 'required']) }}</td>
                                    <td style="padding:6px 10px;">
                                        <div class="flat-rate-text-input">
                                            &euro; {{ Form::text("team[$id][flatrate]", $values['flatrate'], ['class' => 'inline-field', 'width' => '10']) }}
                                        </div>
                                    </td>
                                </tr>
                                <tr class="person-total-row">
                                    <td style="padding:6px 10px;">{{ Form::label('', 'Total', ['class' => 'person-total-text']) }}</td>
                                    <td style="padding:6px 10px;">
                                        <div class="person-total" style="font-weight:bold;">
                                            €0
                                        </div>
                                        {{ Form::hidden("team[$id][persontotal]", $values['persontotal'], ['class' => 'hidden-total']) }}
                                        {{ Form::hidden("team[$id][ratetype]", $values['ratetype'], ['class' => 'hidden-rate-type']) }}
                                    </td>
                                </tr>
                            </table>
                        @endforeach

                        {{--<div style="padding:6px 10px; font-size:16px; font-weight:bold;" class="grand-total">Grand Total: €0</div>--}}

                        {{ form::hidden('person_count', '1', ['class' => 'person-count']) }}
                        <a class="secondary add-new-person">Add new person</a>
                    </div>


                </div>



                {{--Is this an edit of an existing IWO? If a team value has been passed in, it is--}}
            @elseif(isset($workorder->workorder->team))

                {{--If the_work_will_be_done field exists, this is the old model--}}
                @if(isset($workorder->workorder->the_work_will_be_done))
                    <div class="formfield">
                        {{ Form::label('the_work_will_be_done', 'The work will be done', ['class' => 'required']) }}

                        {{ Form::select('the_work_will_be_done', ['' => 'Select one of the following...', 'at the standard FIPRA hourly rates' => 'at the standard FIPRA hourly rates', 'at a different FIPRA hourly rate' => 'at a different FIPRA hourly rate', 'at a daily rate' => 'at a daily rate', 'at a flat or project rate' => 'at a flat or project rate'], (editing()) ? isset($workorder->workorder->the_work_will_be_done) ? $workorder->workorder->the_work_will_be_done : '' : Input::old('the_work_will_be_done'), ['class' => 'inline', 'id' => 'the-work-will-be-done']) }}

                        @include('partials.old_fipraratestable')


                        <div class="fees-people sub-box">
                            {{ Form::label('', 'The following person(s) will work at these rates:') }}
                            <table width="100%">
                                <thead>
                                <td width="60%" class="bold">Name</td>
                                <td width="30%" class="rate-label bold">Rate</td>
                                <td width="10%"></td>
                                </thead>

                                @foreach($workorder->workorder->team as $id => $values)
                                    <tr class="fees-person">
                                        <td class="person-field">{{ Form::text("team[$id][person]", isset($values['person']) ? $values['person'] : '', ['style' => 'width:90%']) }}</td>
                                        <td class="rate-field">
                                            <div class="fees-text">
                                                <span class="inline bold">&euro;</span> {{ Form::text("team[$id][rate]", isset($values['rate']) ? $values['rate'] : '', ['class' => 'inline-field']) }}
                                            </div>
                                            <div class="fees-select">
                                                <span class="inline bold">&euro;</span> {{ Form::select("team[$id][rate]", ['425' => '€425', '325' => '€325', '225' => '€225', '125' => '€125', 'N/A' => 'N/A'], isset($values['rate']) ? $values['rate'] : '', ['class' => 'inline']) }}
                                            </div>
                                        </td>
                                        <td><a class="secondary remove-row" href="#"><i
                                                        class="fa fa-lg fa-times"></i></a></td>
                                    </tr>
                                @endforeach
                            </table>

                            {{ form::hidden('person_count', '1', ['class' => 'person-count']) }}
                            <a class="secondary add-new-person">Add new person</a>

                            <div class="total-project-fee">
                                {{ Form::label('', 'Total project fee:') }}
                                <span class="inline bold"><br/>&euro;</span> {{ Form::text("total_project_fee", (editing()) ? isset($workorder->workorder->total_project_fee) ? $workorder->workorder->total_project_fee : null : Input::old('total_project_fee'), ['class' => 'inline-field']) }}
                            </div>
                        </div>

                        {{ display_form_error('the_work_will_be_done', $errors) }}

                    </div>
                @else
                    {{--Otherwise, it is the new model--}}
                    @include('partials.field_rate_band')

                    <div class="formfield">

                        @include('partials.field_rate_type')

                        <div class="fees-people sub-box">
                            {{ Form::label('', 'The following person(s) will work at these rates:') }}<br>

                            @foreach($workorder->workorder->team as $id => $values)
                                <table width="100%" class="fees-person"
                                       style="background-color:#efefef; margin-bottom:10px;">
                                    <tr>
                                        <td style="padding:6px 10px;" class="person-field">
                                            {{ Form::label('', 'Name', ['class' => 'required']) }}<br>
                                            {{ Form::text("team[$id][person]", isset($values['person']) ? $values['person'] : '', ['class' => 'autofill inline-field']) }}
                                        </td>
                                        <td><a class="secondary remove-row" href="#"><i
                                                        class="fa fa-lg fa-times"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:6px 10px;" colspan="2">
                                            {{ Form::label('', 'Level of Seniority', ['class' => 'required']) }}<br>
                                            <div class="level-select">
                                                {{ Form::select("team[$id][level]", ['account_director' => 'Heads of Network Members/Directors/Partners', 'account_manager' => 'Account Directors/Account Managers', 'account_executive' => 'Account Executives/other junior employees'], isset($values['level']) ? $values['level'] : null, ['class' => 'inline']) }}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="rate-type-days">
                                        <td style="padding:6px 10px;">
                                            {{ Form::label('', 'No. of Days', ['class' => 'required']) }}<br>
                                            <div class="days-text-input" style="width:50%">
                                                {{ Form::text("team[$id][days]", isset($values['days']) ? $values['days'] : '', ['class' => 'inline-field', 'width' => '10']) }}
                                                <br>{{ Form::checkbox("team[$id][per-month]", isset($values['per-month']) ? $values['per-month'] : '') }}
                                                Per month
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="rate-type-days">
                                        <td colspan="3"
                                            style="padding:6px 10px;">@include('partials.days-help-message')</td>
                                    </tr>
                                    <tr class="rate-type-monthly-rate">
                                        <td style="padding:6px 10px;">{{ Form::label('', 'Rate', ['class' => 'required']) }}</td>
                                        <td style="padding:6px 10px;">
                                            <div class="monthly-rate-text-input">
                                                &euro; {{ Form::text("team[$id][monthlyrate]", $values['monthlyrate'], ['class' => 'inline-field', 'width' => '10']) }}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="rate-type-flat-rate">
                                        <td style="padding:6px 10px;">{{ Form::label('', 'Rate', ['class' => 'required']) }}</td>
                                        <td style="padding:6px 10px;">
                                            <div class="flat-rate-text-input">
                                                &euro; {{ Form::text("team[$id][flatrate]", isset($values['flatrate']) ? $values['flatrate'] : '', ['class' => 'inline-field', 'width' => '10']) }}
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="person-total-row">
                                        <td style="padding:6px 10px;">{{ Form::label('', 'Total', ['class' => 'person-total-text']) }}</td>
                                        <td style="padding:6px 10px;">
                                            <div class="person-total" style="font-weight:bold;">
                                                €0
                                            </div>
                                            {{ Form::hidden("team[$id][persontotal]", $values['persontotal'], ['class' => 'hidden-total']) }}
                                            {{ Form::hidden("team[$id][ratetype]", $values['ratetype'], ['class' => 'hidden-rate-type']) }}
                                        </td>
                                    </tr>
                                </table>
                            @endforeach

                            {{--<div style="padding:6px 10px; font-size:16px; font-weight:bold;" class="grand-total">Grand Total: €0</div>--}}

                            {{ form::hidden('person_count', '1', ['class' => 'person-count']) }}
                            <a class="secondary add-new-person">Add new person</a>
                        </div>


                    </div>
                @endif



                {{--Otherwise, use the standard blank fees layout--}}
            @else

                @include('partials.field_rate_band')

                <div class="formfield">

                    @include('partials.field_rate_type')

                    <div class="fees-people sub-box">
                        {{ Form::label('', 'The following person(s) will work at these rates:') }}<br>

                        <table width="100%" class="fees-person" style="background-color:#efefef; margin-bottom:10px;">
                            <tr>
                                <td style="padding:6px 10px;" class="person-field">
                                    {{ Form::label('', 'Name', ['class' => 'required']) }}<br>
                                    {{ Form::text('team[1][person]', null, ['class' => 'autofill inline-field']) }}</td>
                                <td><a class="secondary remove-row" href="#"><i class="fa fa-lg fa-times"></i></a></td>
                            </tr>
                            <tr>
                                <td style="padding:6px 10px;" colspan="2">
                                    {{ Form::label('', 'Level of Seniority', ['class' => 'required']) }}<br>
                                    <div class="level-select">
                                        {{ Form::select('team[1][level]', ['account_director' => 'Heads of Network Members/Directors/Partners', 'account_manager' => 'Account Directors/Account Managers', 'account_executive' => 'Account Executives/other junior employees'], ['class' => 'inline']) }}
                                    </div>
                                </td>
                            </tr>
                            <tr class="rate-type-days">
                                <td style="padding:6px 10px;">
                                    {{ Form::label('', 'No. of Days', ['class' => 'required']) }}<br>
                                    <div class="days-text-input" style="width:50%">
                                        {{ Form::text('team[1][days]', null, ['class' => 'inline-field', 'width' => '10']) }}
                                        <br>{{ Form::checkbox('team[1][per-month]', null, null, ['class' => 'checkbox-per-month']) }}
                                        Per month
                                    </div>
                                </td>
                            </tr>
                            <tr class="rate-type-days">
                                <td colspan="3" style="padding:6px 10px;">@include('partials.days-help-message')</td>
                            </tr>
                            <tr class="rate-type-monthly-rate">
                                <td style="padding:6px 10px;">{{ Form::label('', 'Rate', ['class' => 'required']) }}</td>
                                <td style="padding:6px 10px;">
                                    <div class="monthly-rate-text-input">
                                        &euro; {{ Form::text("team[1][monthlyrate]", null, ['class' => 'inline-field', 'width' => '10']) }}
                                    </div>
                                </td>
                            </tr>
                            <tr class="rate-type-flat-rate">
                                <td style="padding:6px 10px;">{{ Form::label('', 'Rate', ['class' => 'required']) }}</td>
                                <td style="padding:6px 10px;" width="200">
                                    <div class="flat-rate-text-input">
                                        &euro; {{ Form::text('team[1][flatrate]', null, ['class' => 'inline-field', 'width' => '10']) }}
                                    </div>
                                </td>
                            </tr>
                            <tr class="person-total-row">
                                <td style="padding:6px 10px;">{{ Form::label('', 'Total', ['class' => 'person-total-text']) }}</td>
                                <td style="padding:6px 10px;">
                                    <div class="person-total" style="font-weight:bold;">
                                        €0
                                    </div>
                                    {{ Form::hidden('team[1][persontotal]', null, ['class' => 'hidden-total']) }}
                                    {{ Form::hidden('team[1][ratetype]', null, ['class' => 'hidden-rate-type']) }}
                                </td>
                            </tr>
                        </table>

                        {{--<div style="padding:6px 10px; font-size:16px; font-weight:bold;" class="grand-total">Grand Total: €0</div>--}}

                        {{ form::hidden('person_count', '1', ['class' => 'person-count']) }}
                        <a class="secondary add-new-person">Add new person</a>

                    </div>

                </div>

            @endif


            <div class="formfield">
                {{ Form::label('agreed_fee_element', 'Is there any other fee element (e.g. success or finders\' fee)?', ['class' => 'required']) }}
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
                {{ Form::text('work_cap', (editing()) ? isset($workorder->workorder->work_cap) ? $workorder->workorder->work_cap : '' : Input::old('work_cap'), ['class' => 'inline-field inline']) }}
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
            {{ Form::label('replicon_code', 'Replicon code (only applicable to FIPRA International):') }} <a href="#"
                                                                                                             class="help">&nbsp;</a>
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
            @if(editing())
                {{ Form::text('internal_work_order_start_date', isset($workorder->workorder->internal_work_order_start_date) ? $workorder->workorder->internal_work_order_start_date : '', ( ! $loggedin_user->hasRole('SuperUser') ? ['readonly' => 'readonly'] : [])) }}
            @else
                {{ Form::text('internal_work_order_start_date', Input::old('internal_work_order_start_date'), ['class' => 'datepicker', 'id' => 'internal_work_order_start_date_datepicker']) }}
            @endif
            {{ display_form_error('internal_work_order_start_date', $errors) }}
        </div>
        <div class="formfield">
            {{ Form::label('internal_work_order_expiry_date', 'IWO expiry date:', ['class' => 'required']) }} <a
                    href="#" class="help">&nbsp;</a>
            <div class="help-box">This is the date payment will stop under this IWO.</div>
            @if(editing())
                {{ Form::text('internal_work_order_expiry_date', isset($workorder->workorder->internal_work_order_expiry_date) ? $workorder->workorder->internal_work_order_expiry_date : '', ( ! $loggedin_user->hasRole('SuperUser') ? ['readonly' => 'readonly'] : [])) }}
            @else
                {{ Form::text('internal_work_order_expiry_date', Input::old('internal_work_order_expiry_date'), ['class' => 'datepicker', 'id' => 'internal_work_order_expiry_date_datepicker']) }}
            @endif
            {{ display_form_error('internal_work_order_expiry_date', $errors) }}
            <p class="small-print">An email will be sent to you 10 days before this work order expires.</p>
        </div>
        <div class="formfield">
            {{ Form::label('green_sheet_required', 'Is a FIPRA Green Sheet required at the end of each month?', ['class' => 'required']) }}
            <a href="#" class="help">&nbsp;</a>
            <div class="help-box">Green Sheets are to be submitted within three working days of the end of the month in
                which the work has been performed. Green Sheets give details of the hours worked and are irrespective of
                the type of fee structure chosen above.
            </div>
            {{ Form::select('green_sheet_required', ['No' => 'No', 'Yes' => 'Yes'], (editing()) ? isset($workorder->workorder->green_sheet_required) ? $workorder->workorder->green_sheet_required : '' : Input::old('green_sheet_required'), ['class' => 'green-sheet-required']) }}
            {{ display_form_error('green_sheet_required', $errors) }}
        </div>
        <div class="formfield hide" id="green-sheet-required-reveal">
            @include('forms.partials.green_sheet_links')
            <span class="small-print">Green Sheets are to be submitted within three working days of the end of the month in which the work has been performed. Green Sheets give details of the days, quarter days - and in rare cases hours (where a client needs this information) worked and are irrespective of the type of fee structure chosen or the fee agreed above. Such time sheets are only needed for billing purposes.</span>
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
                <h4>Invoices</h4>
                <p>Please note that the Lead Member will not accept an invoice for more than the amount agreed in the
                    Internal Work Order, without prior approval by both sides.</p>
                <p>We are aware that clients may sometimes contact you directly with requests for additional work that
                    is not pre-authorised. Where this happens, please immediately contact the Account Director who will
                    make changes to the budget where possible. Please make the client aware you will need to do this as
                    a matter of course.</p>

                <h4>Caps</h4>
                <p>Some fees have an agreed monthly maximum you may bill or “cap.” This is not the same as a fixed fee
                    for the month. Generally invoices are expected to come in below the cap and any work above the cap
                    cannot be invoiced without an IWO that raises the cap.</p>

                <h4>High Value and Standard Value work</h4>
                <p>FIPRA Network Members, as opposed to Special Advisors, are expected to pay staff high and/or standard
                    rates and apply the correct staffing for the appropriate level of work. No client will pay a top
                    rate, usually reserved for strategic advice, for clerical work such as writing minutes. It is
                    therefore important that staff are correctly allocated and time/billing rates reflect this in line
                    with the internal work order. Where no standard paid staff are available a lower rate must be
                    charged for the higher grade staff doing less valuable work.</p>

                <h4>The internal billing cycle is long, but you can help make it shorter</h4>
                <p>As a matter of policy, FIPRA generally requests payment from clients on 30-day terms. In practice
                    clients often ignore this deadline or impose their own later payment terms. However, further delays
                    can be avoided by Members sending in provisional bills, timesheets and invoices promptly or as early
                    as possible, as a bill covering several Members cannot be ready until the slowest Member has sent
                    theirs in to the Lead Member for approval and processing.</p>

                <h4>When should a Lead Member pay out to subcontracting Members?</h4>
                <p>All payments approved in the IWO system and by the Account Director concerned and therefore due to
                    subcontracting Members of the FIPRA Network are paid out by the Lead Member no later than within 10
                    working days of relevant payments having been received by the Lead Member from the final client. A
                    Member providing work is under no obligation to automatically inform each subcontracting Member
                    every time a bill is paid. However in the event that a Member makes enquiries about payment of a
                    bill, the Lead Member’s Account Director has an obligation to inform the other Member of when
                    clients made payments or, if known, when they are expected to do so.</p>

                <h4>Non-payment or reduced-payments by clients</h4>
                <p>Where there is an IWO, the Lead Member is responsible for paying each Member of the FIPRA Network in
                    respect of services provided to a client that have been agreed and approved. Once the relevant
                    Account Director has accepted the timesheets of a subcontracting Member, and relevant amounts billed
                    by the Lead Member, the Lead Member will bear the risk of reduced payment, default or non-payment by
                    the end client concerned. It will thus ensure that the subcontracting Member is paid in full, if
                    necessary at the Lead Member's own expense. This is in order to protect subcontracting Members from
                    large-scale defaults and from the wrongdoing of another Member that may cause a client not to pay.
                    It also introduces a degree of financial discipline into the work passed between Members. That a
                    client has refused to pay at all cannot be an excuse for internal non-payment.</p>

                <p>However, in the rare event that a client does not pay invoices, or pays less than the amount
                    invoiced, the Lead Member may of course seek to negotiate a reduction with the fellow Member
                    collegially, though the subcontracting Member will not be required to enter into such
                    negotiation.</p>

                <h4>Internal Work Orders</h4>

                <p>Once agreed, copies of all completed online Internal Work Orders are sent promptly to FIPRA’s finance
                    department to enable the monitoring of Inter-Member activities and to facilitate the Membership
                    Review. Internal Work Orders are treated as confidential and are not disclosed to any person outside
                    the FIPRA finance department and the FIPRA Representative for the Member concerned. The Internal
                    Work Orders serve to calculate the general turnover or the services performed between the Members of
                    the FIPRA Network. No Inter-Member payment of any sort or for any work can take place without an
                    Internal Work Order.</p>
            </div>
        </div>

        <p><a href="#top" class="back-to-top">back to top</a></p>

    </section>


    {{ Form::close() }}

@stop

@section('footer')
    @if(Input::has('the_work_will_be_done') || isset($workorder->workorder->the_work_will_be_done))
        <script type="text/javascript" src="{{ asset('js/old_fees_unit.js?160430') }}"></script>
    @else
        <script type="text/javascript" src="{{ asset('js/new_fees_unit.js?160430') }}"></script>
    @endif
@stop