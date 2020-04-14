@extends('layouts.app')

@section('content')
<x-errors/>
<div class="card text-center shadow-lg">
    <div class="card-header">
        <div class="badge badge-info">
            {{ $task->status->name }}
        </div>
    </div>
    <div class="card-body">
        <h5 class="card-title display-4">{{ $task->name }}</h5>
        <p class="card-text lead">{{ $task->description }}</p>
    </div>
    <div class="card-footer text-muted">
        <x-creation-info :model='$task'/>
    </div>
</div>


<hr>
<h4>{{__('Comments')}}</h4>

    {{-- <x-comment-form :route="route('posts.comments.store', compact('post'))"/> --}}
    {{-- <x-comment-list :comments="$post->comments()->with('user', 'tags')->paginate(5)"/> --}}
@endsection('content')
