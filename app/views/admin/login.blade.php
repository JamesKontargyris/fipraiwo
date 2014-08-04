@extends('layouts.master')

@section('nav_links')
<li><a class="highlight" href="/"><i class="fa fa-caret-left"></i> Back to IWO Menu</a></li>
@stop

@section('content')

<h2>Admin Login</h2>

@include('manage.partials.messages')

{{ Form::open() }}
<div class="col-6">
    <p>Enter your admin access code.</p>
    <div class="formfield">
        {{ Form::password('access_code') }}
    </div>
    <div class="formfield">
        {{ Form::submit('Login', ['class' => 'primary']) }}
    </div>
</div>
{{ Form::close() }}

@stop