@extends('layouts.master')

@section('nav_links')
    <li><a class="highlight" href="/users">Back to Dashboard</a></li>
@stop

@section('content')
    @include('partials.errors')

    <div class="row">
        <div class="col-6 last">
            @if(isset($user))
                {{ Form::open(['method' => 'PUT', 'url' => 'users/' . $user->id]) }}
            @else
                {{ Form::open(['route' => 'users.store']) }}
            @endif

            <div class="formfield">
                {{ Form::label('name', 'Name:') }}
                {{ Form::text('name', (isset($user)) ? $user->name : Input::old('name'), ['class' => 'required', 'required' => 'required']) }}
                {{ display_form_error('name', $errors) }}
            </div>
            <div class="formfield">
                {{ Form::label('email', 'Email:') }}
                {{ Form::email('email', (isset($user)) ? $user->email : Input::old('email'), ['class' => 'required', 'required' => 'required']) }}
                {{ display_form_error('email', $errors) }}
            </div>
            <div class="formfield">
                @if(isset($user))
                    {{ Form::label('password', 'New Password:') }}
                @else
                    {{ Form::label('password', 'Password:') }}
                @endif
                {{ Form::password('password', ['class' => 'required']) }}
                    {{ display_form_error('password', $errors) }}
            </div>
            <div class="formfield">
                {{ Form::label('password_confirmation', 'Confirm Password:') }}
                {{ Form::password('password_confirmation', ['class' => 'required']) }}
                {{ display_form_error('password_confirmation', $errors) }}
            </div>
            @if( ! isset($user))
                <div class="formfield">
                    {{ Form::label('role_id', 'User role:') }}
                    {{ Form::select('role_id', $role_options, Input::old('role_id'), ['class' => 'required']) }}
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            @if(isset($user))
                {{ Form::submit('Update', ['class' => 'primary']) }}
            @else
                {{ Form::submit('Add', ['class' => 'primary']) }}
            @endif
            {{ Form::close() }}
                <br><a href="/users" class="secondary">Cancel</a>
        </div>
    </div>
@stop