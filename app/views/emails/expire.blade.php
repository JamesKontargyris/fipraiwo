<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>{{ $data['subject'] }}</h2>

		<p>The following IWO will expire in 7 days' time.</p>

		<div>
			@include('emails.partials.form')
		</div>

        <div>
            @include('emails.partials.notes_unit')
        </div>
	</body>
</html>