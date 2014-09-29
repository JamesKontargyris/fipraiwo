@extends('layouts.master')

@section('content')
    <h2>Thank you</h2>
    <h3>New work order reference: {{ Session::get('iwo_ref') }}</h3>
    <p>Your work order was re-submitted. You and all relevant parties will receive a notification to confirm this update shortly.</p>
    <p>Please note the updated work order reference above. You will need this to manage this work order in the future.</p>
    <p>
    	<a href="/manage/view" class="secondary"><i class="fa fa-edit"></i> Continue managing this work order</a>
    	<a href="/manage/logout" class="secondary"><i class="fa fa-home"></i> Return to IWO homepage</a>
    </p>
@stop