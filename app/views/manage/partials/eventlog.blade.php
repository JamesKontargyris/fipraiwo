<h5 class="no-underline">Event Log</h5>
@if(count($workorder->logs) > 0)
<ul class="log-list">
    @foreach($workorder->logs as $log)
    <li class="entry {{ $log->type }}">
        <p>{{ $log->log }}</p>
        <div class="small-print">
            @if(isset($log->name) && $log->name != '')
				By {{ $log->name }}<br/>
			@elseif(isset($log->user->name) && $log->user->name != '')
				By {{ $log->user->name }}<br/>
			@endif
            {{ date("d M Y", strtotime($log->created_at)) }} at {{ date("g.i", strtotime($log->created_at)) }}
        </div>

    </li>
    @endforeach
</ul>
@else
No Events.
@endif