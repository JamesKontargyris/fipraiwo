@extends('layouts.master')

@section('nav_links')
<li><a class="highlight" href="/"><i class="fa fa-caret-left"></i> Back to IWO Menu</a></li>
@stop

@section('content')

<h2>Login</h2>

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
        <p>Once logged in, you will be able to view the work order, edit it if you are the lead contact and confirm it. Lorem ipsum dolor sit amet, consectetur adipisicing elit. At dolor eveniet fugit inventore ipsum iure magnam molestiae mollitia nam natus, officia quam, ratione veritatis. Atque dolore doloremque officia repellendus vitae.</p>
    </div>
{{ Form::close() }}

@stop