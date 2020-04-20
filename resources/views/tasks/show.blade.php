@extends('layouts.app')

@section('content')
<x-errors/>

<div class="shadow-lg">
    <div class="ui centered fluid card">
        <div class="content">
            <div class="meta">
                <span class="category"><a class="ui red left ribbon label"><h4>{{ $task->status->name }}</h4></a></span>
                <span class="right floated time">{{ $task->created_at->diffForHumans() }}</span>
            </div>
        </div>
        <div class="center aligned header"><h1 class="ui header">{{ $task->name }}</h1></div>
            <div class="description center aligned">
            <p>{{ $task->description }}</p>
        </div>
        <div class="extra content">
            <hr>
            <x-labels :labels='$task->labels'/>
            <div class="right floated author">
                <img class="ui avatar image" src="{{ isset($task->creator->image) ? $task->creator->image->url : "https://udemy-project-1.s3.eu-west-3.amazonaws.com/avatars/default-user-image.png" }}">
                <a href="{{ route('users.show', $task->creator) }}">{{ $task->creator->name }}</a>
            </div>
        </div>
    </div>
</div>

<hr>

<div class="custom-bottom">
    <h1 class="ui header">{{__('Comments')}}</h1>
</div>

<x-comments :model='$task'/>

@endsection('content')


