@if(!editing())
	<section class="col-12 formgroup highlight">
		<div class="formfield">
			<i class="fa fa-envelope fa-lg white"></i>&nbsp;&nbsp;{{ Form::label('also_send_work_order_to', 'If you would like to send a copy of this IWO to other recipients, please enter their email addresses here (separated by a comma):') }}
			{{ Form::text('also_send_work_order_to') }}
			<span class="small-print white">Email addresses entered here will be sent a copy of your submitted IWO and will be able to view it at any time. They will be notified when this IWO is updated or confirmed, or when notes are added.</span>

			{{--Hidden field for removing AD-specific copy contacts when the AD is changed--}}
			{{ Form::hidden('account_directors_contacts', '', ['id' => 'account_directors_contacts', 'disabled' => 'disabled']) }}
			{{ display_form_error('also_send_work_order_to', $errors) }}
		</div>
	</section>
@endif