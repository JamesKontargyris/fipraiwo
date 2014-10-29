<!DOCTYPE html>
<html lang="en-US">
@include('emails.partials.head')
<body>
<h2>{{ $data['subject'] }}</h2>
@include('emails.partials.iwo_ref')
<p>A note was added to this work order by {{ $data['user_name'] }}:</p>

<h3><em>{{ $data['note'] }}</em></h3>

Visit <a href="http://iwo.fipra.com/manage">http://iwo.fipra.com/manage</a> to login and view this IWO. To login, you will need the reference code above and your email address.</p>
</body>
</html>