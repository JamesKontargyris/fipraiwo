<!DOCTYPE html>
<html lang="en-US">
@include('emails.partials.head')
<body>
<h2>{{ $data['subject'] }}</h2>
@include('emails.partials.iwo_ref')
<p>A note was added to this work order. Visit <a href="http://fipraiwo.jamkon.co.uk/manage">http://fipraiwo.jamkon.co.uk/manage</a> to login and view the note. To login, you will need the reference code above and your email address.</p>
</body>
</html>