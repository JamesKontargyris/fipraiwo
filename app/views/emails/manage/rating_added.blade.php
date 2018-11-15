<!DOCTYPE html>
<html lang="en-US">
@include('emails.partials.head')
<body>
<h2>{{ $data['subject'] }}</h2>
@include('emails.partials.iwo_ref')
<p>A rating of <strong>{{ $data['score'] }} out of 5</strong> has been added by {{ $data['user_name'] }} for this work order.</p>

<p>
@for($i = 1; $i <= $data['score']; $i++)
    <img src="http://iwo.fipra.com/img/rating-star.png" alt="Star {{ $i }}">
@endfor

@for($i = 1; $i <= (5 - $data['score']); $i++)
    <img src="http://iwo.fipra.com/img/rating-star-o.png" alt="">
@endfor
</p>

@if($data['comment'])
    <h4>Comments</h4>
    <p>{{ $data['comment'] }}</p>
@endif

<p>A copy of this work order can be found below. Alternatively, visit <a href="http://iwo.fipra.com/manage">http://iwo.fipra.com/manage</a> to login and view / manage the work order. To login, you will need the reference code above and your email address.</p>

<div>
    @include('emails.partials.form')
</div>

<div>
    @include('emails.partials.notes_unit')
</div>
</body>
</html>