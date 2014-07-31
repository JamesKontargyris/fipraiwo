<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>{{ $data['subject'] }}</h2>
@include('emails.partials.iwo_ref')
<p>A Fipra Units IWO was recently submitted, listing you as the sub-contracting unit. Other information here.</p>
<p>A copy of the submitted IWO is included below.</p>
<p>If you wish to confirm or query this work order, please visit LINK HERE using the reference code above and your email address to login.</p>

<div>
    @include('emails.partials.form')
</div>
</body>
</html>