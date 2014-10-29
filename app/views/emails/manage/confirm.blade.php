<!DOCTYPE html>
<html lang="en-US">
@include('emails.partials.head')
<body>
<h2>{{ $data['subject'] }}</h2>
@include('emails.partials.iwo_ref')
<p>This work order has been confirmed. A copy of this work order can be found below. Alternatively, visit <a href="http://iwo.fipra.com/manage">http://iwo.fipra.com/manage</a> to login and view / manage the work order. To login, you will need the reference code above and your email address.</p>

<div>
    @include('emails.partials.form')
</div>
</body>
</html>