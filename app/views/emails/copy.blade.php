<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>{{ $data['subject'] }}</h2>

		@include('emails.partials.resend_message')

		<p>The following IWO was submitted. The submitter requested that you receive a copy.</p>

		@include('emails.partials.status_manage')

		<div>
			@include('emails.partials.form')
		</div>
        <br/>
        <div>
            @include('emails.partials.notes_unit')
        </div>
	</body>
</html>