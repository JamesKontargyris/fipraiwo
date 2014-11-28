@extends('layouts.master')

@section('content')

    @if(editing())
    	<div class="col-9">
			<p>Please look over your updated work order and re-submit at the end of the page, or click 'Go Back' to make changes.</p>
			<h4>Please note: your updated IWO will not be processed until you click the 'Approve and Re-submit Work Order' button at the bottom of the page.</h4>
    	</div>
    @else
    	<div class="col-9">
			<p>Please look over the details you have entered and submit your IWO at the end of the page, or click 'Go Back' to make changes.</p>
			<h4>Please note: your IWO will not be submitted until you click the 'Approve and Submit Work Order' button at the bottom of the page.</h4>
    	</div>
    @endif

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
        @if(editing())
            {{ link_to('manage/edit', 'Go Back', ['class' => 'secondary']) }}
        @else
            {{ link_to("$iwo_key", 'Go Back', ['class' => 'secondary']) }}
        @endif

        @if(editing())
                {{ link_to("manage/update", 'Approve and Re-submit Work Order', ['class' => 'primary swap-for-loading', 'id' => 'submit']) }}
        @else
                {{ link_to("$iwo_key/save", 'Approve and Submit Work Order', ['class' => 'primary swap-for-loading', 'id' => 'submit']) }}
            <p class="small-print">Please note: if you uploaded files on the previous page and choose to go back, you will need to select those files again.</p>
        @endif
    </div>

    @include('forms.partials.loading')

    <script>
    	$('a').click(function () { window.onbeforeunload = null; });
    	$('input[type=submit]').click(function () { window.onbeforeunload = null; });

    	window.onbeforeunload = function() {
            return 'Your IWO has not yet been submitted.';
        };
    </script>
@stop