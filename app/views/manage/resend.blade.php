@extends('layouts.master')

@section('content')
<h2>Re-send Email(s)</h2>
<p>Select the users associated with this IWO who should receive emails. Users selected will receive a copy of their original IWO submission email with the most up to date data for IWO reference '{{ Session::get('iwo_ref') }}'.</p>

<p class="js-block showjs">
	<a class="secondary select-all"><i class="fa fa-check"></i> Select All</a>
	<a class="secondary deselect-all"><i class="fa fa-times"></i> Deselect All</a>
</p>
{{ Form::open() }}
<table class="workorder-table" width="100%">
	<thead>
		<tr>
			<td></td>
			<td>Email address</td>
			<td>Name</td>
			<td>Role</td>
		</tr>
	</thead>
	@foreach($users as $user)
		<tr>
		<td width="80px">
			{{ Form::checkbox('users[]', $user['id']) }}
		</td>
		<td>
			{{ $user['email'] }}
		</td>
		<td>
			{{ $user['name'] }}
		</td>
		<td>
			{{ $user['roles'] }}
		</td>
		</tr>
	@endforeach
</table>
<br/>
{{ Form::submit('Send', ['class' => 'primary']) }}
{{ Form::close() }}
<a href="/manage/view" class="secondary">Cancel</a>

@stop