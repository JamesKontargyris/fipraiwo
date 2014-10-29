<!DOCTYPE html>
<html lang="en-US">
@include('emails.partials.head')
<body>
<h2>{{ $data['subject'] }}</h2>

@include('emails.partials.resend_message')

@include('emails.partials.iwo_ref')
<h3><strong>{{ link_to('http://iwo.fipra.com/manage', 'CLICK HERE TO MANAGE THIS IWO') }}</strong></h3>
<p>Thank you for re-submitting your Fipra Units IWO.</p>
<p>A copy of your re-submitted IWO is included below. A copy has been sent to the sub-contracted unit Account Director you entered in the form, as well as other relevant parties.</p>

@include('emails.partials.status_manage')

<div>
    @include('emails.partials.form')
</div>
</body>
</html>