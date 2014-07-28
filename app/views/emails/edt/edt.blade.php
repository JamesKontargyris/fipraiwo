<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>{{ $data['subject'] }}</h2>
        @include('emails.partials.iwo_ref')
		<p>Thank you for submitting your project request. A member of the EDT team will be in touch shortly to confirm receipt of your request and to discuss the project further with you.</p>
		<p>If you requested a consultation, this will be arranged with the relevant member(s) of our team shortly.</p>
		<p>A copy of your project request is included below. Please do not hesitate to contact us on <a href="mailto:edt@fipra.com">edt@fipra.com</a> should you have any queries.</p>

		<div>
			@include('emails.partials.form')
		</div>
	</body>
</html>