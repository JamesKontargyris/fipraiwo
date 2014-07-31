<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>{{ $data['subject'] }}</h2>
@include('emails.partials.iwo_ref')
<p>Thank you for submitting your Fipra Units IWO.</p>
<p>A copy of your submitted IWO request is included below. A copy has been sent to the sub-contracted unit Account Director you entered in the form, as well as other relevant parties.</p>
<p>If you wish to edit this work order, please visit LINK TO WORK ORDER LOGIN and use the reference code and your email address above to login.</a></p>

<div>
    @include('emails.partials.form')
</div>
</body>
</html>