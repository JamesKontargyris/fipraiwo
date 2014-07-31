@extends('layouts.master')

@section('nav_links')
<li><a class="highlight" href="/"><i class="fa fa-caret-left"></i> Back to IWO Menu</a></li>
<li><a class="highlight" href="/manage/logout">Logout</a></li>
@stop

@section('content')
<h2>{{ $workorder->title }}<br/><small>Ref: {{ $workorder->iwo_ref }}</small></h2>

@include('manage.partials.messages')

<div class="col-12">
    <section class="outline-box col-4">
        @include('manage.partials.status')
    </section>

    <section class="outline-box col-8 last">
        @include('manage.partials.actions')
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
            @if(strtotime($workorder->updated_at) == strtotime($workorder->created_at))
                No updates.
            @else
                {{ date("d M Y, g.ia", strtotime($workorder->updated_at)) }}
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
        @include('manage.partials.notes')
    </section>

    <section class="outline-box">
        @include('manage.partials.eventlog')
    </section>
</div>
@stop