@extends('layouts.master')

@section('content')

    <h3>Please login to continue.</h3>
    <h6 style="margin-bottom:20px;"><a href="/password/reset">Forgotten your password?</a></h6>

    @include('partials.errors')

    <div class="login-form-container" style="padding:10px 20px; background-color:#efefef; margin-bottom:20px;">
        <h2>Submit a new IWO</h2>

        {{ Form::open(['files' => false, 'url' => '/login']) }}

        <section class="col-6" style="margin-bottom:0;">
            <div class="formfield">
                {{ Form::label('email', 'Email Address:', ['class' => 'required']) }}
                {{ Form::text('email') }}
                {{ display_form_error('email', $errors) }}
            </div>
        </section>

        <section class="col-6 last" style="margin-bottom:0;">
            <div class="formfield">
                {{ Form::label('password', 'Password:', ['class' => 'required']) }}
                {{ Form::password('password') }}
                {{ display_form_error('password', $errors) }}
            </div>
        </section>

        <section class="col-12" style="margin-bottom:0;">
            {{ display_submit_button('Login') }}
        </section>

        <div style="clear: both"></div>

        {{ Form::close() }}
    </div>

    <div class="login-form-container" style="padding:10px 20px; background-color:#efefef;">
        <h2>Manage an existing IWO</h2>

        {{ Form::open(['files' => false, 'url' => 'login/manage']) }}

        <section class="col-4" style="margin-bottom:0;">
            <div class="formfield">
                {{ Form::label('manage_email', 'Email Address:', ['class' => 'required']) }}
                {{ Form::text('manage_email') }}
                {{ display_form_error('manage_email', $errors) }}
            </div>
        </section>

        <section class="col-4" style="margin-bottom:0;">
            <div class="formfield">
                {{ Form::label('manage_password', 'Password:', ['class' => 'required']) }}
                {{ Form::password('manage_password') }}
                {{ display_form_error('manage_password', $errors) }}
            </div>
        </section>

        <section class="col-4 last" style="margin-bottom:0;">
            <div class="formfield">
                {{ Form::label('iwo_ref', 'IWO Reference:', ['class' => 'required']) }}
                {{ Form::text('iwo_ref') }}
                {{ display_form_error('iwo_ref', $errors) }}
            </div>
        </section>

        <section class="col-12">
            {{ display_submit_button('Login') }}
        </section>

        <div style="clear: both"></div>

        {{ Form::close() }}
    </div>
@stop
