@extends('layouts.master')

@section('nav_links')
@stop

@section('content')

<h2>SuperUser Dashboard <a href="/admin/logout" class="red-but"><i class="fa fa-times"></i> LOGOUT</a></h2>

@include('manage.partials.messages')

{{ Form::open() }}
<div class="col-12">
    <h3>Work Orders involving Peter-Carlo Lehrell</h3>

	<?php $count = 0; ?>
	<table cellspacing="10" cellpadding="10" border="1" width="100%" class="workorder-table">
		<thead>
		<tr>
			<td>Title</td>
			<td>Lead AD</td>
			<td>Sub AD</td>
			<td>Created on</td>
			<td>Last updated</td>
			<td>Status</td>
			<td></td>
		</tr>
		</thead>
		@foreach($workorders as $workorder)
			<?php $count++; $workorder_details = unserialize($workorder->workorder); ?>
			<tr>
				<td><a href="/admin/view/{{ $workorder->id }}"><strong>{{ $workorder->title }}</strong></a></td>
				<td><?php echo $workorder_details['lead_unit_account_director']; ?></td>
				<td><?php echo $workorder_details['sub_contracted_unit_correspondent_affiliate_account_director']; ?></td>
				<td>{{ date('d M y - g.i', strtotime($workorder->created_at)) }}</td>
				<td>
					@if(strtotime($workorder->created_at) == strtotime($workorder->updated_at))
						-
					@else
						{{ date('d M y - g.i', strtotime($workorder->updated_at)) }}
					@endif
				</td>
				<td>
					@if($workorder->cancelled)
						Cancelled
					@elseif( ! $workorder->cancelled && $workorder->confirmed)
						Confirmed
					@else
						Unconfirmed
					@endif
				</td>
				<td class="action-buttons" style="text-align: right;">
					<a class="secondary" href="/admin/delete/{{ $workorder->id }}" onClick="return confirm('Are you sure you want to delete this IWO? This action cannot be undone.');"><i class="fa fa-lg fa-times"></i></a>
				</td>
			</tr>
		@endforeach

		@if($count == 0)
			<tr>
				<td colspan="4">No work orders found.</td>
			</tr>
		@endif
	</table>
</div>
{{ Form::close() }}

@stop