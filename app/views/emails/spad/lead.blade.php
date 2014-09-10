<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>{{ $data['subject'] }}</h2>
@include('emails.partials.iwo_ref')
<p>Please find below a copy of your recently submitted IWO. A copy has been sent to the Account Director listed below, as well as other relevant parties.</p>

<div>
    @include('emails.partials.form')
</div>
</body>
</html>