<!DOCTYPE html>
<html lang="en-US">
@include('emails.partials.head')
<body>
<h2>{{ $data['subject'] }}</h2>
@include('emails.partials.iwo_ref')
<p>This work order was submitted and confirmed.</p>

@if($data['include_rating_link'])
    <h3>Please rate this IWO</h3>
    <p><strong>Please <a href="http://iwo.fipra.com/rate?confirmation={{ $data['confirmation'] }}&iwo_id={{ $data['iwo_id'] }}&user_id={{ $data['user_id'] }}&email={{ $data['email'] }}">click here</a> to rate this IWO or copy and paste the following URL into your browser: http://iwo.fipra.com/rate?confirmation={{ $data['confirmation'] }}&iwo_id={{ $data['iwo_id'] }}&user_id={{ $data['user_id'] }}&email={{ $data['email'] }}</strong></p>
@endif

<div>
    @include('emails.partials.form')
</div>

<div>
    @include('emails.partials.notes_unit')
</div>
</body>
</html>