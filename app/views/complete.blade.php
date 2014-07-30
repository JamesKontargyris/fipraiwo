@extends('layouts.master')

@section('content')
	<h2>Thank You</h2>
    @if(Session::get('iwo_ref'))
        <h3>Work Order reference: <span class="bold">{{ Session::get('iwo_ref') }}</span></h3>
    @endif
	<p>Your work order has been submitted. It has been sent to the relevant parties.</p>
	<p>A copy of your Work Order has also been sent to you. A copy of the work order reference above is included; please keep it in a safe place as it is required to view or edit (if you have editing rights) this work order in the future.</p>
	<p>{{ link_to('/manage', 'Manage this work order', ['class' => 'primary']) }} {{ link_to('/', 'Go back to the IWO menu', ['class' => 'primary']) }}</p>
@stop