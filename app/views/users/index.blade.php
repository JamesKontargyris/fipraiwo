@extends('layouts.master')

@section('nav_links')
    <li><a class="highlight" href="/">IWO Home</a></li>
    <li><a class="highlight" href="/logout">Logout</a></li>
@stop

@section('content')
    @include('partials.messages')
    @include('partials.errors')

    <a href="{{ route('users.create') }}" class="secondary"><i class="fa fa-plus-circle"></i> Add a User</a>

    @if(count($items) > 0)

        <section class="index-table-container">
            <div class="row">
                <div class="col-12">
                    <table width="100%" class="index-table">
                        <thead>
                        <tr>
                            <td rowspan="2" width="40%">User</td>
                            <td rowspan="2" width="15%" class="hide-s">Email</td>
                            <td rowspan="2" width="10%" class="hide-s">Role</td>
                            <td rowspan="2" colspan="2" class="hide-print">Actions</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $user)
                            <tr>
                                <td><strong>{{ $user->name }}</strong></td>
                                <td class="hide-s">{{ $user->email }}</td>
                                <td class="hide-s">{{ $user->roles()->pluck('name') }}</td>
                                <td class="actions content-right hide-print">
                                    {{ Form::open(['route' => array('users.edit', $user->id), 'method' => 'get']) }}
                                    <button type="submit" class="primary" ><i class="fa fa-pencil"></i></button>
                                    {{ Form::close() }}
                                </td>
                                <td class="actions content-right hide-print">
                                    {{ Form::open(['route' => array('users.destroy', $user->id), 'method' => 'delete']) }}
                                    <button type="submit" class="red-but delete-row" data-resource-type="user"><i class="fa fa-times"></i></button>
                                    {{ Form::close() }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

    @else
        <div class="row">
            <div class="col-12">
                No records found.
            </div>
        </div>
    @endif
@stop