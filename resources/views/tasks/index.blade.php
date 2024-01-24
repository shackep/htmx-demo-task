@extends('layouts.app')

@section('content')
    @include('tasks.title')
    <p><button hx-get="{{ route('tasks.editname', session('group_key')) }}" hx-target="h1" hx-select='form'>Rename this List</button>
    <button type="button" hx-replace-url="true" hx-get="{{ route('tasks.index') }}?new_group_key=true" hx-target='body' hx-swap='outerHTML'>Start new list</button></p>
@include('tasks.count')
    @include('tasks.new')
    @include('tasks.tasks')

@if (count($lists) > 0)
    <h2>Your other lists</h2>
    <ul>
    @foreach ($lists as $list_group_key => $name)
        <li><a href="{{ url('/tasks/' . $list_group_key) }}">{{ $name ?? 'Task List' }}</a></li>
    @endforeach
    </ul>

@endif

    <div style="text-align:center;margin:32px">
        <img width="350px" loading="lazy" src="{{ asset('resources/images/createdwith.jpeg') }}">
    </div>
    <p>This site is a playground for learning HTMX. It is not intended to be a production site. It could be deleted/destroyed at any moment. It is not intended to be a secure or fast site. It is intended to be a site that demonstrates the power of HTMX. See it on github here: <a href="https://github.com/shackep/htmx-demo-task">Github</a></p>
@endsection

