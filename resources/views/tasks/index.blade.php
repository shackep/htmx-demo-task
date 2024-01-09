@extends('layouts.app')

@section('content')
    <h1>Task List</h1>
    @if(session('group_key'))
    <p>Save this link to come back to your task list: <a href="{{ url('/tasks/' . session('group_key')) }}">{{ url('/tasks/' . session('group_key')) }}</a></p>
    @endif
    @include('tasks.count')
    @include('tasks.new')
    @include('tasks.tasks')
@endsection


