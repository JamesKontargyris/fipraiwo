@extends('layouts.master')

@section('content')
	<p>Please confirm the details you have entered:</p>
	<ul class="display-details">
		@foreach($input as $field => $value)
			<li>
				<strong>{{ $field }}:</strong> <span>{{ $value }}</span>
			</li>
		@endforeach
		@if(Session::get('file_names'))
			@foreach(Session::get('file_names') as $field_name => $file_name)
				<li>
					<strong>File:</strong> <span>{{ $file_name }}</span>
				</li>
			@endforeach
		@endif
	</ul>

	<div class="buttons">
		{{ link_to("$iwo_key", 'Go back', ['class' => 'secondary']) }}
		{{ link_to("$iwo_key/saveandsend", 'Confirm and Send', ['class' => 'primary swap-for-loading', 'id' => 'submit']) }}
	</div>
	<p class="small-print">Please note: if you uploaded files on the previous page and choose to go back, you will need to select those files again.</p>
	@include('forms.partials.loading')
@stop