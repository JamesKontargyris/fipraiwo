<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>{{ $data['subject'] }}</h2>

		<p>The following IWO was submitted. You were listed as a Fipra Representative. For further information, please contact the lead unit, sub-contracted unit, Special Adviser etc. as applicable using the contact details below.</p>

		<div>
			@include('emails.partials.form')
		</div>
        <br/>
        <div>
            @include('emails.partials.notes_unit')
        </div>

	</body>
</html>