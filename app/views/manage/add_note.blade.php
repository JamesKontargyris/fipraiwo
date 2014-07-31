@extends('layouts.master')

@section('content')
<h2>Add a note to &quot;{{ $workorder->title }}&quot;</h2>

<section class="col-6">
    {{ Form::open() }}
        {{ Form::textarea('note', null, ['rows' => '8']) }}
        {{ Form::submit('Add Note', ['class' => 'primary']) }}
    {{ Form::close() }}
    <a href="/manage/view" class="secondary">Cancel</a>
</section>
@stop