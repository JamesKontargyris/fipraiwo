@extends('layouts.master')

@section('nav_links')
<li><a class="highlight" href="/"><i class="fa fa-caret-left"></i> Back to IWO Homepage</a></li>
@stop

@section('content')

<h2>Login</h2>

<p>This section allows you to manage IWOs. Depending on your status, you may be able to edit, confirm and/or cancel work orders. All users can add notes to IWOs.</p>

@include('manage.partials.messages')

{{ Form::open() }}
<div class="col-6">
    <p>Enter your email address and IWO reference to manage your work order.</p>
    <div class="formfield">
            {{ Form::label('email', 'Email Address:', ['class' => 'required']) }}
            {{ Form::text('email', null) }}
        </div>
        <div class="formfield">
            {{ Form::label('iwo_ref', 'Work Order Reference:', ['class' => 'required']) }}
            {{ Form::text('iwo_ref', null) }}
        </div>
        <div class="formfield">
            {{ Form::submit('Go', ['class' => 'primary']) }}
        </div>
    </div>
    <div class="col-6 last">
        <h3><i class="fa fa-info-circle"></i> Information</h3>
        <p>In most cases, a new IWO will need to be submitted where a new programme of work follows on from a previous one.</p>
        <p>If you amend an IWO, a new reference code will be created and sent to other parties for confirmation. You will be notified of this updated code by email.</p>
    </div>
{{ Form::close() }}

	<div class="col-12">
		<p><a class="secondary" href="/"><i class="fa fa-home"></i> Return to IWO Homepage</a></p>
	</div>

@stop