<!DOCTYPE html>
<html lang="en-US">
@include('emails.partials.head')
<body>
<h2>{{ $data['subject'] }}</h2>
@include('emails.partials.iwo_ref')
<p>This work order was {{ $data['cancelled_or_confirmed'] }} seven days ago, but you have not yet left a rating. A copy of this work order can be found below.</p>

<p><strong>Please <a href="http://iwo.fipra.com/rate?confirmation={{ $data['confirmation'] }}&iwo_id={{ $data['iwo_id'] }}&user_id={{ $data['user_id'] }}&email={{ $data['email'] }}">click here</a> to rate this IWO or copy and paste the following URL into your browser: http://iwo.fipra.com/rate?confirmation={{ $data['confirmation'] }}&iwo_id={{ $data['iwo_id'] }}&user_id={{ $data['user_id'] }}&email={{ $data['email'] }}</strong></p>

<div>
    @include('emails.partials.form')
</div>

<div>
    @include('emails.partials.notes_unit')
</div>
</body>
</html>