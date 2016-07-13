@extends('layouts.master')

@section('content')

    <h2>Change your password</h2>

    @include('partials.errors')
    @include('partials.messages')

    <p><strong>If you have arrived here after logging in</strong>: please update your temporary password to something more memorable to you. This is a security measure that ensures only you have access to your IWO account.</p>

    <div>
        {{ Form::open(['files' => false, 'url' => '/password/change', 'method' => 'POST']) }}

        <section class="col-6" style="margin-bottom:0;">
            <div class="formfield">
                {{ Form::label('current_password', 'Your current password:', ['class' => 'required']) }}
                {{ Form::password('current_password') }}
                {{ display_form_error('current_password', $errors) }}
            </div>

            <div class="formfield">
                {{ Form::label('new_password', 'Your new password:', ['class' => 'required']) }}
                {{ Form::password('new_password') }}
                {{ display_form_error('new_password', $errors) }}
            </div>

            <div class="formfield">
                {{ Form::label('new_password_confirmation', 'Confirm your new password:', ['class' => 'required']) }}
                {{ Form::password('new_password_confirmation') }}
                {{ display_form_error('new_password_confirmation', $errors) }}
            </div>

        </section>

        <section class="col-12" style="margin-bottom:0;">
            {{ Form::hidden('your_temporary_password', $pass) }}
            {{ display_submit_button('Change Password') }}
            <a href="/" class="secondary">Cancel</a><br><br>
            <p style="font-style: italic">If you cancel this step and are yet to update your temporary supplied password, you put your account at risk (you will also be asked to change your password every time you login).</p>
        </section>

        {{ Form::close() }}
    </div>

@stop
