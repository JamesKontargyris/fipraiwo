@extends('layouts.master')

@section('content')

    @if(Session::has('msg'))
        <div class="errors">
            <i class="fa fa-warning fa-lg"></i> <strong>{{ Session::get('msg') }}</strong>
        </div>
    @endif

    {{ Form::open(['files' => false, 'url' => 'login']) }}

    <section class="col-6">
        <div class="formfield">
            {{ Form::label('access_code', 'Access code:', ['class' => 'required']) }}
            {{ Form::password('access_code') }}
            {{ display_form_error('access_code', $errors) }}
        </div>

        {{ display_submit_button('Login') }}
    </section>

    {{ Form::close() }}
@stop
