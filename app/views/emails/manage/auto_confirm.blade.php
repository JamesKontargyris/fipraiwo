<!DOCTYPE html>
<html lang="en-US">
@include('emails.partials.head')
<body>
<h2>{{ $data['subject'] }}</h2>
@include('emails.partials.iwo_ref')
<p>This work order was submitted and confirmed.</p>

<div>
    @include('emails.partials.form')
</div>
</body>
</html>