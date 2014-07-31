<!DOCTYPE html>
<html lang="en-US">
@include('emails.partials.head')
<body>
<h2>{{ $data['subject'] }}</h2>
@include('emails.partials.iwo_ref')
<p>Thank you for submitting your Fipra Units IWO.</p>
<p>A copy of your submitted IWO request is included below. A copy has been sent to the sub-contracted unit Account Director you entered in the form, as well as other relevant parties.</p>

@include('emails.partials.status_manage')

<div>
    @include('emails.partials.form')
</div>
</body>
</html>