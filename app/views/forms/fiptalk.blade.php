@extends('layouts.master')

@section('nav_links')
	<li><a href="/" class="highlight"><i class="fa fa-caret-left fa-lg"></i> Back to IWO Menu</a></li>
@stop

@section('content')
	<div class="intro">
		<p>Submitting and agreeing an IWO, constitutes a binding contractual agreement. As such IWOs should only be submitted by, or on instruction of, Account Director level Fipriots.</p>
	</div>

	@include('forms.partials.messages')

    @if(editing())
        {{ Form::open(['files' => true, 'url' => 'manage/confirmupdates']) }}
    @else
        {{ Form::open(['files' => true, 'url' => 'fiptalk']) }}
    @endif

    @include('forms.partials.workorder_title_ref')

	<section class="col-6">
		<div class="formfield">
			{{ Form::label('person_requiring_assistance', 'Person requiring assistance from Fiptalk:', ['class' => 'required']) }}
            @if(editing())
            {{ Form::text('person_requiring_assistance', $workorder->workorder->person_requiring_assistance, ['readonly' => 'readonly']) }}
            @else
                {{ Form::text('person_requiring_assistance', Input::old('person_requiring_assistance')) }}
            @endif
			{{ display_form_error('person_requiring_assistance', $errors) }}
		</div>
		<div class="formfield">
			{{ Form::label('unit_special_adviser_or_correspondent', 'Name of Unit / Special Adviser / Correspondent:', ['class' => 'required']) }}
			@if(editing())
                {{ Form::text('unit_special_adviser_or_correspondent', $workorder->workorder->unit_special_adviser_or_correspondent, ['readonly' => 'readonly']) }}
            @else
                {{ Form::text('unit_special_adviser_or_correspondent', Input::old('unit_special_adviser_or_correspondent')) }}
            @endif
			{{ display_form_error('unit_special_adviser_or_correspondent', $errors) }}
		</div>
		<div class="formfield">
			{{ Form::label('lead_email_address', 'Contact email address:', ['class' => 'required']) }}
			@if(editing())
                {{ Form::email('lead_email_address', $workorder->workorder->lead_email_address, ['readonly' => 'readonly']) }}
            @else
                {{ Form::email('lead_email_address', Input::old('email_address')) }}
            @endif

			{{ display_form_error('email_address', $errors) }}
		</div>
		<div class="formfield">
			{{ Form::label('project_and_client_company_name', 'Project and client company name (where relevant):') }} <a href="#" class="help">&nbsp;</a>
			<div class="help-box">Please also denote if work is for internal or external use.</div>
			{{ Form::text('project_and_client_company_name', (editing()) ? $workorder->workorder->project_and_client_company_name : Input::old('project_and_client_company_name')) }}
			{{ display_form_error('project_and_client_company_name', $errors) }}
		</div>
		<div class="formfield">
			{{ Form::label('replicon_code', 'Replicon code (only applicable to Fipra International):') }}
			{{ Form::text('replicon_code', (editing()) ? $workorder->workorder->replicon_code : Input::old('replicon_code')) }}
			{{ display_form_error('replicon_code', $errors) }}
		</div>
		<div class="formfield">
			{{ Form::label('time_frame', 'In which time frame do you need Fiptalk?', ['class' => 'required']) }} <a href="#" class="help">&nbsp;</a>
			<div class="help-box">If you would like the EDT to factor in a second modification round after the initial draft, we'll be pleased to include this as part of our project planning. Subject to time, we can plan further modification rounds as the project progresses. Please indicate time constraints as early as possible so we can effectively plan to meet your deadlines.</div>
			{{ Form::text('time_frame', (editing()) ? $workorder->workorder->time_frame : Input::old('time_frame')) }}
			{{ display_form_error('time_frame', $errors) }}
		</div>
		<div class="formfield">
			{{ Form::label('require_cost_estimate', 'Do you require a cost estimate?', ['class' => 'required']) }}
			{{ Form::select('require_cost_estimate', ['' => 'Please select...', 'No' => 'No', 'Yes' => 'Yes'], (editing()) ? $workorder->workorder->require_cost_estimate : Input::old('require_cost_estimate')) }}
			{{ display_form_error('require_cost_estimate', $errors) }}
		</div>
	</section>

	<section class="col-6 last">
		<div class="formfield">
			{{ Form::label('service_coaching_or_training_required', 'Service, coaching or training required:', ['class' => 'required']) }}
			<div>{{ Form::checkbox('speech_making', (editing()) ? $workorder->workorder->speech_making : Input::old('speech_making')) }} Speech Making: preparation and delivery</div>
			<div>{{ Form::checkbox('presenting', (editing()) ? $workorder->workorder->presenting : Input::old('presenting')) }} Presenting: preparation and delivery</div>
			<div>{{ Form::checkbox('pitching', (editing()) ? $workorder->workorder->pitching : Input::old('pitching')) }} Pitching: how to do it effectively</div>
			<div>{{ Form::checkbox('committee_and_meeting_skills', (editing()) ? $workorder->workorder->committee_and_meeting_skills : Input::old('committee_and_meeting_skills')) }} Committee and Meeting Skills</div>
			<div>{{ Form::checkbox('strategic_communication_skills', (editing()) ? $workorder->workorder->strategic_communication_skills : Input::old('strategic_communication_skills')) }} Strategic Communication Skills</div>
			<div>{{ Form::checkbox('media_handling', (editing()) ? $workorder->workorder->media_handling : Input::old('media_handling')) }} Media Handling: including statement writing and giving interviews</div>
		</div>
		<div class="formfield">
			{{ Form::label('individual_or_group_coaching', 'Is this individual or group coaching?', ['class' => 'required']) }}
			{{ Form::select('individual_or_group_coaching', ['' => 'Please select...', 'Individual' => 'Individual', 'Group' => 'Group'], (editing()) ? $workorder->workorder->individual_or_group_coaching : Input::old('individual_or_group_coaching')) }}
			{{ display_form_error('individual_or_group_coaching', $errors) }}
		</div>
		<div class="formfield">
			{{ Form::label('group_numbers', 'If group coaching, please indicate how many people in each category:') }}
			{{ Form::textarea('group_numbers', (editing()) ? $workorder->workorder->group_numbers : Input::old('group_numbers'), ['rows' => '4']) }}
			{{ display_form_error('group_numbers', $errors) }}
		</div>
		<div class="formfield">
			{{ Form::label('instructions', 'Any other specific instructions:') }} <a href="#" class="help">&nbsp;</a>
			<div class="help-box">Please indicate special instructions, explanatory information, guidance on tone, target audience, objectives etc.</div>
			{{ Form::textarea('instructions', (editing()) ? $workorder->workorder->instructions : Input::old('instructions'), ['rows' => '4']) }}
			{{ display_form_error('instructions', $errors) }}
		</div>
	</section>

	@include('forms.partials.copy_emails')

	<section class="col-12" style="clear:both">

		<p class="small-print">
			Once your IWO is submitted, you will be contacted by Fiptalk for a consultation.
		</p>

		{{ display_submit_button('Next') }}
		@include('forms.partials.loading')


		<div class="grey-box">
			<div class="col-10 last">
	            <h4>What is Fiptalk?</h4>
	            <p>Fiptalk is a team of freelance professional coaches selected by Fipra to provide expert training in oral and written presentation skills. Fiptalk is about helping Fipriots and Fipra’s clients become effective speakers, presenters or pitchers by being clear, engaging and persuasive. If you have any upcoming speeches, presentations, important meetings then time with Fiptalk could be just what you need. This professional Fipra service is also available as a Fipra service to Fipra clients.</p>
	            
	            <h4>Confidentiality</h4>
	            <p>All members of Fiptalk sign a personal non-disclosure agreement with financial penalties for non-observance. The work you do together with the team is treated confidentially by each individual on the team and is not shared with anyone.</p>
	            
	            <h4>Costs</h4>
	            <p>Typically this type of coaching requires at least one two hour session. Fiptalk charges a preferential internal rate to the Fipra Network of €500 (plus expenses) for each 2 hour session. Externally, a minimum of €1,500 per 2 hour session will be charged and where applicable an inter-unit discount will be given to the introducing Fipra unit. Cost estimates can be given in advance of agreeing work that requires more than two hours. If the team have to travel, relevant disbursements would be charged at cost on top.</p>

	            <h4>Invoicing</h4>
	            <p>Fiptalk team members invoice monthly to Fipra International who will onward bill to other parts of the network or to clients as appropriate.  Similar to other the Fipra services, such as the EDT or Fiplex, the Fiptalk team enjoys affiliate membership of the Fipra Network. In effect, for invoicing purposes, Fiptalk functions the same way as a Special Adviser does, available only through Fipra International.</p>

	            <h4>Membership of the Fiptalk team</h4>
	            <p>The founding members of the Fiptalk team are all based in Europe but the team is looking to expand membership geographically and welcomes all suggestions for new members made by colleagues in the Fipra Network. With sufficient notice, it can be arranged for the team to travel to work with individuals or with groups.</p>

	            <h4>Meet the Fiptalk Team</h4>
	            <p><strong>Alp Mehmet – Coach  (Fiptalk Team Co-ordinator)</strong></p>
	            <p>Alp is the Fiptalk team leader and worked for the UK government for over 38 years, mostly for the Foreign and Commonwealth Office. Alp has been a Special Adviser and member of the Fipra network since 2009. Alp trains and coaches people in public speaking, presenting and media handling at all levels in the public and private sectors.  Alp is a perceptive and inspirational motivator with a sensitive touch, who writes regularly for publications and websites and speaks on immigration, social issues, domestic politics and foreign affairs.</p>
	            <p>Alp can show you how to put a presentation together and guide you on preparing and delivering it in the most attractive and credible way possible. Often it is simply a matter of coaxing the best out of each person by showing them how they might add colour, sparkle and “a bit of magic” to a presentation or speech that might otherwise be bland, flat or unconvincing. Self-belief, motivation and inspiration are an integral part of what Alp does, along with the requisite amount of Fipriotic fun!</p>
	            <p>Alp is happy to provide advice, guidance or training on media handling too. How to deal with a threatening situation; when and how to put out information, be it in the form of a press release or an article; how to attract media attention; how to prepare and give interviews (TV, radio and print); and how to use social media – especially Twitter.</p>

	            <p><strong>Pippa Prideaux – Coach</strong></p>
	            <p>Pippa is a communication and voice coach.  Her initial training was as a speech teacher which gives her a good technical background in working with the voice in performance. Pippa has much experience in working with second language speakers and has a second teacher diploma in teaching English as a Second Language.  For many years Pippa has worked as a freelance coach and speechwriter in England and abroad and has also worked as a communication specialist for executive coaching consultancies such as GHN, The Change Partnership, Whitehead Mann and Praesta.  Her client list ranges from people in top jobs in organisations such as The BBC, Shell International, UBS Bank Ltd, Capital One, Europcar International to young people just starting their careers.</p>
	            <p>Pippa helps people with their talking at work, whatever that may be.  All sessions are completely tailor made to meet the needs of the individual, there are no off the shelf solutions.  Her work has been described as ‘communication psychology’ because it frequently helps people to review counter-productive mind-sets and beliefs.  Pippa works together with individuals to discover what is obstructing the road to excellent communication.  Pippa helps people to build awareness of their impact on others and to develop an empathetic understanding of the needs of their listeners.   By offering sound techniques and a clear understanding of the process, Pippa gives people the confidence to be authentic and to be the best possible and most appropriate versions of themselves.  Pippa’s work does not only embrace public speaking. Some people need to review the way they communicate in meetings, others seek support to find an effective way to talk to those working for and with them.  A key area of her work is to help clients to understand the physiology of stress so that they are well equipped to manage themselves effectively in challenging situations.  Pippa aims to create an encouraging and safe environment in which to explore communication issues.</p>

	            <p><strong>Elena Shalneva – Coach</strong></p>
	            <p>Elena Shalneva has worked in investor relations, financial PR and fund management and started her career in political campaigning in Washington, D.C. Elena moved to the UK in 1997 to work for a financial communications consultancy Citigate Dewe Rogerson and later joined the investor relations team of Brunswick  moving to Paris. Most recently, Elena was founding partner of the PR agency Newgate. In addition to teaching presentation skills, Elena is a regular presenter herself, having appeared on BBC News, BBC Regional Radio, Radio France Info, as well as in numerous print publications in the UK, France and Italy Elena was educated at Moscow University and Harvard University and has an MBA from INSEAD. She is fluent in English, Russian and French.</p>

                   <p>Elena’s training method is based on a simple premise that in a presentation, content drives the style, and a powerful, convincing, logical narrative ensures confident and charismatic delivery. Elena does not teach superficial presentation techniques and 80% of her work is focused on content: how to structure one’s thoughts, deliver messages which are concise and specific and avoid common presentation flaws, such as generalisations, jargon, banalities.  The remainder is focused on delivery:  voice, presence, body language.</p>
            </div>
        </div>

        <p><a href="#top" class="back-to-top">back to top</a></p>
	</section>

	{{ Form::close() }}
@stop