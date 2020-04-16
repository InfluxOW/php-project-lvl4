@extends('layouts.app')

@section('content')

<h1 class="display-4">Edit Task</h1>

{{ Form::open(['url' => route('tasks.update', $task), 'method' => 'PATCH', 'class' => 'ui form']) }}
    @include('tasks._form')
    {{ Form::submit(__('Update'), ['class' => 'ui primary button fluid']) }}
{{ Form::close() }}
@endsection('content')
