@extends('layouts.master')

@section('content')
	<h2>Thank You</h2>
	<p>Your work order has been submitted. It has been sent to the relevant parties within Fipra.</p>
	<p>A copy of your Work Order has also been sent to the email address you registered.</p>
	<p>{{ link_to('/', 'Go back to the IWO menu', ['class' => 'primary']) }}</p>
@stop