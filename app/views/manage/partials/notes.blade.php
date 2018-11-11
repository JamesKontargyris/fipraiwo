<h5 class="no-underline">NOTES</h5>
@if(count($workorder->notes) > 0)
<ul class="log-list">
    @foreach($workorder->notes as $note)
    <li class="note">
        <p>{{ $note->note }}</p>
        <div class="small-print">
        	@if(isset($note->name) && $note->name != '')
        		{{ $note->name }}<br/>
        	@elseif(isset($note->user->name) && $note->user->name != '')
            	{{ $note->user->name }}<br/>
            @endif
            {{ date("d M Y", strtotime($note->created_at)) }} at {{ $note->created_at->timezone('Europe/Brussels')->format("g.ia") }}</div>

    </li>
    @endforeach
</ul>
@else
No notes.
@endif