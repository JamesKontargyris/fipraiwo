<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>{{ $data['subject'] }}</h2>

<p>The following IWO was submitted. You are listed as Account Director. More information here.</p>

<div>
    @include('emails.partials.form')
</div>
</body>
</html>