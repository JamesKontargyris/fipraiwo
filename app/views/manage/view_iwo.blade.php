@extends('layouts.master')

@section('nav_links')
<li><a class="highlight" href="/manage/logout">Logout</a></li>
@stop

@section('content')
<h2>{{ $workorder->title }} <small>(Ref: {{ $workorder->iwo_ref }})</small></h2>

<div class="col-12">
    <section class="outline-box col-4">
        <h5 class="no-underline">STATUS</h5>
        @if($workorder->confirmed && ! $workorder->cancelled)
        <div class="green-highlight"><i class="fa fa-lg fa-lock"></i> CONFIRMED</div>
        @elseif($workorder->cancelled && ! $workorder->confirmed)
        <div class="red-highlight"><i class="fa fa-lg fa-times"></i> CANCELLED</div>
        @else
        <div class="orange-highlight"><i class="fa fa-lg fa-unlock"></i> UNCONFIRMED</div>
        @endif
    </section>

    <section class="outline-box col-8 last">
        <h5>ACTIONS</h5>
        <ul class="actions">
            @if($user->can('edit'))
            <li>EDIT</li>
            @endif
            @if($user->can('confirm'))
            <li>CONFIRM</li>
            @endif
            @if($user->can('comment'))
            <li>ADD A NOTE</li>
            @endif
            @if($user->can('cancel'))
            <li>CANCEL</li>
            @endif
        </ul>
    </section>
</div>

<div class="col-8">
    <div>
        <section class="outline-box col-6">
            <h5>Created</h5>
            {{ date("d M Y, g.ia", strtotime($workorder->created_at)) }}
        </section>
        <section class="outline-box col-6 last">
            <h5>Last updated</h5>
            {{ date("d M Y, g.ia", strtotime($workorder->updated_at)) }}
        </section>
    </div>
    <div class="col-12">
        <ul class="display-iwo outline-box">
            @foreach($workorder->workorder as $field => $value)
            <li>
                <strong>{{ $field }}:</strong> <span>{{ $value }}</span>
            </li>
            @endforeach
        </ul>
    </div>
</div>

<div class="col-4 last">
    <section class="outline-box">
        <h5>NOTES</h5>
        @if($workorder->notes)
            <ul class="notes">
                @foreach($workorder->notes as $note)
                    <li class="note">
                        <p>{{ $note['note'] }}</p>
                        <div class="small-print">{{ $note['author'] }} on {{ date("d M Y", strtotime($note['datetime'])) }} at {{ date("h.ia", strtotime($note['datetime'])) }}</div>

                    </li>
                @endforeach
            </ul>
        @else
            <p>No notes.</p>
        @endif
    </section>
</div>
@stop