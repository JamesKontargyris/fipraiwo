<h5 class="no-underline">Event Log</h5>
@if(count($workorder->logs) > 0)
<ul class="log-list">
    @foreach($workorder->logs as $log)
    <li class="entry {{ $log->type }}">
        <p>{{ $log->log }}</p>
        <div class="small-print">
            By {{ $log->user->name }}<br/>
            {{ date("d M Y", strtotime($log->created_at)) }} at {{ date("g.i", strtotime($log->created_at)) }}
        </div>

    </li>
    @endforeach
</ul>
@else
No Events.
@endif