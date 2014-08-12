@extends('layouts.master')

@section('nav_links')
<li><a class="highlight" href="/admin/logout"><i class="fa fa-caret-left"></i> Logout</a></li>
@stop

@section('content')

<h2>SuperUser Dashboard</h2>

@include('manage.partials.messages')

{{ Form::open() }}
<div class="col-12">
    <h3>Work Orders by Type</h3>

    @foreach($formtypes as $formtype)
    	<?php $count = 0; ?>
        <h4>{{ $formtype->label }}</h4>
		<table cellspacing="10" cellpadding="10" border="1" width="100%" class="workorder-table">
			<thead>
			<tr>
				<td>Title</td>
				<td>Created on</td>
				<td>Last updated</td>
				<td>Status</td>
			</tr>
			</thead>
        	@if(count($formtype->workorders) > 0)
                @foreach($formtype->workorders as $workorder)
                	@if($workorder->expiry_date > date('Y-m-d'))
                		<?php $count++; ?>
						<tr>
							<td><a href="/admin/view/{{ $workorder->id }}"><strong>{{ $workorder->title }}</strong></a></td>
							<td>{{ date('d M y - h.i', strtotime($workorder->created_at)) }}</td>
							<td>
								@if(strtotime($workorder->created_at) == strtotime($workorder->updated_at))
									-
								@else
									{{ date('d M y - h.i', strtotime($workorder->updated_at)) }}
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
						</tr>
                	@endif
                @endforeach

                @if($count == 0)
                	<tr>
						<td colspan="4">No workorders found.</td>
					</tr>
				@endif
       		@else
				<tr>
					<td colspan="4">No workorders found.</td>
				</tr>
			@endif
        </table>
        <br/><br/>
    @endforeach
</div>
{{ Form::close() }}

@stop