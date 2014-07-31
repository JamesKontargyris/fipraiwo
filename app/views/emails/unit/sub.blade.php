<!DOCTYPE html>
<html lang="en-US">
@include('emails.partials.head')
<body>
<h2>{{ $data['subject'] }}</h2>
@include('emails.partials.iwo_ref')
<p>A Fipra Units IWO was recently submitted, listing you as the sub-contracted unit contact.</p>
<p>A copy of the submitted IWO is included below.</p>

@include('emails.partials.status_manage')

<div>
    @include('emails.partials.form')
</div>
</body>
</html>