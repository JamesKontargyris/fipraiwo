@extends('layouts.master')

@section('nav_links')
<li><a class="highlight" href="/"><i class="fa fa-caret-left"></i> Back to IWO Menu</a></li>
@stop

@section('content')
<h2>
    {{ $workorder->title }}
    <br/><small>Ref: {{ $workorder->iwo_ref }}</small>
    @if($rating)
        <br><span class="rating-stars">
            <?php
			$ratingFullStars = intval($rating); // number of whole stars to show
			$halfStar = ($rating - $ratingFullStars) ? 1 : 0;
			$i = 1;
			while($i <= $ratingFullStars) {
				echo '<i class="fa fa-star"></i>';
				$i++;
			}
			if($halfStar) {
				echo '<i class="fa fa-star-half"></i>';
			}
			?>
        </span> <small>{{ $no_of_ratings }} @if($no_of_ratings == 1) rating @else ratings @endif</small>
    @endif
</h2>

@include('manage.partials.messages')

<div class="col-12" style="margin-bottom:0">
	<section class="outline-box">
		Logged in as: <strong>{{ $loggedin_user->email }} ({{ $loggedin_user->name }})</strong>
	</section>
</div>

<div class="col-12">
    <section class="outline-box col-3">
        @include('manage.partials.status')
    </section>

    <section class="outline-box col-9 last">
    	<h5 class="no-underline">ACTIONS</h5>
        @include('manage.partials.actions')
    </section>
</div>

<div class="col-8">
    <div>
        <section class="outline-box col-6">
            <h5>Created</h5>
            {{ date("d M Y, g.i", strtotime($workorder->created_at)) }}
        </section>
        <section class="outline-box col-6 last">
            <h5>Last updated</h5>
            @if(strtotime($workorder->updated_at) == strtotime($workorder->created_at))
                No updates.
            @else
                {{ date("d M Y, g.i", strtotime($workorder->updated_at)) }}
            @endif
        </section>
    </div>
    <div class="col-12">
        <ul class="display-iwo outline-box">
            @foreach($workorder->pretty_workorder as $field => $value)
            <li>
                <strong>{{ $field }}:</strong> <span>{{ $value }}</span>
            </li>
            @endforeach
        </ul>
    </div>
</div>

<div class="col-4 last">
    <section class="outline-box">
        @include('manage.partials.ratings')
    </section>

    <section class="outline-box">
        @include('manage.partials.notes')
    </section>

    <section class="outline-box">
        @include('manage.partials.eventlog')
    </section>
</div>
@stop