<div class="formfield highlight">
	{{ Form::label('registered_email', 'Link an email address to this Work Order:', ['class' => 'required']) }}
	<p>
		{{ Form::text('registered_email', Input::old('registered_email')) }}
		{{ display_form_error('registered_email', $errors) }}
	</p>
	<p>A copy of this Work Order will be sent to the email address you enter. It will also be used for online viewing of this Work Order and accessing future functionality.</p>

</div>