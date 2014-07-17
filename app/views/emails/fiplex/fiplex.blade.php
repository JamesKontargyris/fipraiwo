<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>{{ $data['subject'] }}</h2>
<p>Thank you for submitting your Fiplex IWO. A member of our team will be in touch shortly to confirm receipt of your request and to discuss the matter further with you.</p>
<p>A copy of your submitted IWO is included below. Please do not hesitate to contact us on <a href="mailto:fiplex@fipra.com">fiplex@fipra.com</a> should you have any queries.</p>

<div>
    @include('emails.partials.form')
</div>
</body>
</html>