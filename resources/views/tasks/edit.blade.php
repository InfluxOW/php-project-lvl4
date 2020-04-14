@extends('layouts.app')

@section('content')

<h1 class="display-4 mb-5">Edit Task</h1>

{{ Form::open(['url' => route('tasks.update', $task), 'method' => 'PATCH']) }}
    @include('tasks._form')
    {{ Form::submit(__('Update'), ['class' => 'btn btn-primary btn-block']) }}
{{ Form::close() }}
@endsection('content')
