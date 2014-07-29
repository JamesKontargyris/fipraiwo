@extends('layouts.master')

@section('content')

    <p>User logged in. Details:</p>
    <p>{{ Auth::user() }}</p>
    <p><a href="manage/logout">Logout</a></p>

@stop