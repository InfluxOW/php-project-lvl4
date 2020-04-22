@extends('layouts.app')

@section('content')
<x-errors/>

<div class="card text-center shadow-lg">
    <div class="card-header">
        <div class="badge badge-info">
            <h4>{{ $task->status->name }}</h4>
        </div>
    </div>
    <div class="card-body">
        <h5 class="card-title display-4">{{ $task->name }}</h5>
        <p class="card-text lead">{{ $task->description }}</p>
    </div>
    <div class="card-footer text-muted">
        <x-creation-info :model='$task'/>
        <x-labels :labels='$task->labels'/>
    </div>
</div>

<hr>
<h4>{{__('Comments')}}</h4>

<x-comments :model='$task'/>
@endsection('content')


