<!DOCTYPE html>
<html lang="en-US">
@include('emails.partials.head')
<body>
<h2>{{ $data['subject'] }}</h2>

@include('emails.partials.resend_message')

@include('emails.partials.iwo_ref')

<h3><strong>{{ link_to('/confirm?id=' . $data['iwo_id'] . '&email=' .$data['recipient'] . '&code=' . $data['confirmation_code'], 'CLICK HERE TO CONFIRM THIS IWO') }}</strong></h3>

<p>This IWO was recently re-submitted, listing you as the sub-contracted unit contact.</p>
<p>A copy of the re-submitted IWO is included below.</p>

@include('emails.partials.status_manage')

<p><a href="http://iwo.fipra.com/downloads/green_sheet_template.xls">Click here to download a Green Sheet</a>.</p>
<p><a href="http://iwo.fipra.com/downloads/green_sheet_instructions.pdf">Click here to download Green Sheet instructions</a>.</p>

<div>
    @include('emails.partials.form')
</div>
</body>
</html>