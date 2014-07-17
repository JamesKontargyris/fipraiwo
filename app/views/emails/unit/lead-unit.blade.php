<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>{{ $data['subject'] }}</h2>
<p>Thank you for submitting your Fipra Units IWO.</p>
<p>A copy of your submitted IWO request is included below. A copy has been sent to the sub-contracted unit Account Director you entered in the form, as well as other relevant parties.</p>

<div>
    @include('emails.partials.form')
</div>
</body>
</html>