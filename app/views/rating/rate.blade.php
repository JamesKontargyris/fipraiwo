@extends('layouts.master')

@section('content')
    <h2>Rate IWO &quot;{{ $workorder->title }}&quot;</h2>

    <section class="col-6">
        {{ Form::open() }}
        <div class="rating-stars rating-stars--big starrr"></div>
        {{ Form::hidden('rating', '') }}

        <div class="rating-stars-reveal">
            {{ Form::label('comment', 'Additional comments:') }}
            {{ Form::textarea('comment', null, ['rows' => '8']) }}

            {{ Form::hidden('iwo_id', Input::get('iwo_id')) }}
            {{ Form::hidden('iwo_ref', Input::get('iwo_ref')) }}
            {{ Form::hidden('user_id', Input::get('user_id')) }}
            {{ Form::submit('Add Rating', ['class' => 'primary rating-submit', 'onclick="if (!confirm(\'Are you happy to submit your rating?\')) return false;"', 'disabled' => 'disabled']) }}
            {{ Form::close() }}
        </div>
        @if(isset($user->id))
            <a href="/manage/view" class="secondary">Cancel</a>
        @else
            <a href="/" class="secondary">Cancel</a>
        @endif
    </section>
@stop