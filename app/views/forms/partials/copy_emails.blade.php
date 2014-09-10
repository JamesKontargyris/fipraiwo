@if(!editing())
	<section class="col-12 formgroup highlight">
		<div class="formfield">
			<i class="fa fa-envelope fa-lg white"></i>&nbsp;&nbsp;{{ Form::label('also_send_work_order_to', 'If you would like to send a copy of this IWO to other recipients, please enter their email addresses here (separated by a comma):') }}
			{{ Form::text('also_send_work_order_to') }}
		</div>
	</section>
@endif