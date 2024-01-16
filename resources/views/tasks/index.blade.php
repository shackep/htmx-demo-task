@extends('layouts.app')

@section('content')
    @include('tasks.title')
    <button hx-get="{{ route('tasks.editname', session('group_key')) }}" hx-target="h1" hx-select='form'>Rename List</button>
    @if(session('group_key'))
    <p>Save this link to come back to your task list: <a href="{{ url('/tasks/' . session('group_key')) }}">{{ url('/tasks/' . session('group_key')) }}</a></p>
    @endif
    @include('tasks.count')
    @include('tasks.new')
    <button type="button" hx-confirm="Are you sure you wish to leave this list and start another one? This is your chance to make sure you have this url to come back to: {{ url('/tasks/' . session('group_key')) }}" hx-replace-url="true" hx-get="{{ route('tasks.index') }}?new_group_key=true" hx-target='body' hx-swap='outerHTML'>Start new task list</button>
    @include('tasks.tasks')
    <div style="text-align: center;margin:32px">
        <img width="90%" loading="lazy" src="{{ asset('resources/images/createdwith.jpeg') }}">
    </div>
    <p>This site is a playground for learning HTMX. It is not intended to be a production site. It could be deleted/destroyed at any moment. It is not intended to be a secure or fast site. It is intended to be a site that demonstrates the power of HTMX.</p>
@endsection

