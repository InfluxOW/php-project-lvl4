@extends('layouts.app')

@section('content')

<h1 class="display-4">Add New Task</h1>

{{ Form::open(['url' => route('tasks.store'), 'class' => 'ui form']) }}
    @include('tasks._form')
    {{ Form::submit(__('Create'), ['class' => 'ui primary button fluid']) }}
{{ Form::close() }}
@endsection('content')
