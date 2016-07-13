@extends('layouts.master')

@section('content')

    <h2>Reset your password</h2>

    @include('partials.errors')

    <div>
        {{ Form::open(['files' => false, 'url' => '/password/reset']) }}

        <section class="col-6" style="margin-bottom:0;">
            <div class="formfield">
                {{ Form::label('email', 'Enter your email address:', ['class' => 'required']) }}
                {{ Form::text('email') }}
                {{ display_form_error('email', $errors) }}
            </div>

            <p>A temporary password will be emailed to you. You will be prompted to change your password when you login with your temporary password.</p>
        </section>

        <section class="col-12" style="margin-bottom:0;">
            {{ display_submit_button('Reset Password') }}
            <a href="/" class="secondary">Cancel</a>
        </section>

        {{ Form::close() }}
    </div>

@stop
