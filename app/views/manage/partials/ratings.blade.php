<h5 class="no-underline">RATINGS</h5>
@if(count($workorder->ratings) > 0)
<ul class="log-list">
    @foreach($workorder->ratings as $rating)
    <li class="note">
        <p>
            <?php for($i = 1; $i <= $rating->score; $i++) : ?>
                <i class="fa fa-star sidebar-rating-star-filled"></i>
            <?php endfor; ?>
            <?php for($i = 1; $i <= (5 - $rating->score); $i++) : ?>
                <i class="fa fa-star-o sidebar-rating-star-outline"></i>
            <?php endfor; ?>
        </p>
        @if($rating->comment)
            <p>&quot;{{ nl2br(trim($rating->comment)) }}&quot;</p>
        @endif
        <div class="small-print">
            {{ $rating->user->name }}<br/>
            {{ date("d M Y", strtotime($rating->created_at)) }} at {{ date("g.i", strtotime($rating->created_at)) }}</div>

    </li>
    @endforeach
</ul>
@else
No ratings.
@endif