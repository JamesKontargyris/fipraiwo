@extends('layouts.master')

@section('nav_links')
<li><a class="highlight" href="/admin/logout"><i class="fa fa-caret-left"></i> Logout</a></li>
@stop

@section('content')

<h2>SuperUser Dashboard</h2>

@include('manage.partials.messages')

{{ Form::open() }}
<div class="col-12">
    <h3>Work Orders by Type</h3>

    @foreach($formtypes as $formtype)
        <h4>{{ $formtype->label }}</h4>
        @if(count($formtype->workorders) > 0)
            <table cellspacing="10" cellpadding="10" border="1" width="100%" class="workorder-table">
                <thead>
                <tr>
                    <td>Title</td>
                    <td>Created on</td>
                    <td>Last updated</td>
                    <td>Status</td>
                </tr>
                </thead>
                @foreach($formtype->workorders as $workorder)
                <tr>
                    <td><a href="/admin/view/{{ $workorder->id }}">{{ $workorder->title }}</a></td>
                    <td>{{ date('d M y - h.ia', strtotime($workorder->created_at)) }}</td>
                    <td>
                        @if(strtotime($workorder->created_at) == strtotime($workorder->updated_at))
                            -
                        @else
                            {{ date('d M y - h.ia', strtotime($workorder->updated_at)) }}
                        @endif
                    </td>
                    <td>
                        @if($workorder->cancelled)
                            Cancelled
                        @elseif( ! $workorder->cancelled && $workorder->confirmed)
                            Confirmed
                        @else
                            Unconfirmed
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>

        @else
            <p>No workorders found.</p>
        @endif
        <br/><br/>
    @endforeach
</div>
{{ Form::close() }}

@stop