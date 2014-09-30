@extends('layouts.master')

@section('content')

    @if(editing())
        <p>Please look over your update work order:</p>
    @else
        <p>Please confirm the details you have entered:</p>
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
                {{ link_to("manage/update", 'Update and Re-submit Work Order', ['class' => 'primary swap-for-loading', 'id' => 'submit']) }}
        @else
                {{ link_to("$iwo_key/save", 'Submit Work Order', ['class' => 'primary swap-for-loading', 'id' => 'submit']) }}
            <p class="small-print">Please note: if you uploaded files on the previous page and choose to go back, you will need to select those files again.</p>
        @endif
    </div>

    @include('forms.partials.loading')
@stop