<!DOCTYPE html>
<html lang="en-US">
@include('emails.partials.head')
<body>
<h2>{{ $data['subject'] }}</h2>
@include('emails.partials.iwo_ref')
<p>This work order has been updated and re-submitted. The latest version of this IWO can be found below.</p>
<p>You are receiving this email as the IWO creator requested that you receive a copy.</p>

@include('emails.partials.status_manage')

<div>
    @include('emails.partials.form')
</div>

</body>
</html>