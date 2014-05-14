@foreach($data['form_data'] as $field => $value)
	<p>
		<strong>{{ $field }}:</strong><br><span>{{ nl2br($value) }}</span>
	</p>
@endforeach