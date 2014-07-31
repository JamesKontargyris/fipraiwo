<h5 class="no-underline">NOTES</h5>
@if(count($workorder->notes) > 0)
<ul class="log-list">
    @foreach($workorder->notes as $note)
    <li class="note">
        <p>{{ $note->note }}</p>
        <div class="small-print">
            {{ $note->user->name }}<br/>
            {{ date("d M Y", strtotime($note->created_at)) }} at {{ date("g.ia", strtotime($note->created_at)) }}</div>

    </li>
    @endforeach
</ul>
@else
No notes.
@endif