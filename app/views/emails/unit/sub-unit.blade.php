<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>{{ $data['subject'] }}</h2>
<p>A Fipra Units IWO was recently submitted, listing you as the sub-contracting unit. Other information here.</p>
<p>A copy of the submitted IWO is included below.</p>

<div>
    @include('emails.partials.form')
</div>
</body>
</html>