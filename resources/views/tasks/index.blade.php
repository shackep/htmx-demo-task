@extends('layouts.app')

@section('content')
    <h1>Task List</h1>
    @if(session('group_key'))
    <p>Save this link to come back to your task list: <a href="{{ url('/tasks/' . session('group_key')) }}">{{ url('/tasks/' . session('group_key')) }}</a></p>
    @endif
    @include('tasks.count')
    @include('tasks.new')
    @include('tasks.tasks')
    <div style="text-align: center;margin:32px">
        <img width="90%" loading="lazy" src="{{ asset('resources/images/createdwith.jpeg') }}">
    </div>
    <p>This site is a playground for learning HTMX. It is not intended to be a production site. It could be deleted/destroyed at any moment. It is not intended to be a secure or fast site. It is intended to be a site that demonstrates the power of HTMX.</p>
@endsection

