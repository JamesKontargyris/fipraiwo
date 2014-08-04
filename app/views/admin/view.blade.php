@extends('layouts.master')

@section('nav_links')
<li><a class="highlight" href="/admin/dashboard"><i class="fa fa-caret-left"></i> Back to dashboard</a></li>
@stop

@section('content')

<h2>Viewing &quot;{{ $workorder->title }}&quot;</h2>

<div class="col-8">
    <table class="workorder-table">
        @foreach($workorder->workorder as $label => $value)
        <tr>
            <td width="45%"><strong>{{ $label }}:</strong></td>
            <td width="55%">{{ $value }}</td>
        </tr>
        @endforeach
    </table>
</div>

<div class="col-4 last">
    <section class="outline-box">
        @include('manage.partials.status')
    </section>
    <section class="outline-box">
        <h5>Created</h5>
        {{ date("d M Y, g.ia", strtotime($workorder->created_at)) }}
    </section>
    <section class="outline-box">
        <h5>Last updated</h5>
        @if(strtotime($workorder->updated_at) == strtotime($workorder->created_at))
        No updates.
        @else
        {{ date("d M Y, g.ia", strtotime($workorder->updated_at)) }}
        @endif
    </section>
    <section class="outline-box">
        @include('manage.partials.notes')
    </section>
</div>

<p style="clear:both"><a class="secondary" href="/admin/dashboard"><i class="fa fa-caret-left"></i> Back to dashboard</a></p>

@stop