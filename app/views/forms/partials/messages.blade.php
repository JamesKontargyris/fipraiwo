@if($errors->any())
	<div class="errors">
		<i class="fa fa-warning fa-lg"></i> <strong>Please address the following errors.</strong>
	</div>
@endif

@if(isset($file_error))
	<div class="errors">
		<i class="fa fa-warning fa-lg"></i> <strong>{{ $file_error }}</strong>
	</div>
@endif