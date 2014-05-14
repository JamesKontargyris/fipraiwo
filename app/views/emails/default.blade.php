<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>{{ $data['subject'] }}</h2>

		<p>The following IWO was submitted:</p>

		<div>
			@include('emails.partials.form')
		</div>
	</body>
</html>