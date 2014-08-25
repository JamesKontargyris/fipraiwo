<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>{{ $data['subject'] }}</h2>

		<p>The following IWO was submitted. The submitter requested that you receive a copy.</p>

		<div>
			@include('emails.partials.form')
		</div>
	</body>
</html>