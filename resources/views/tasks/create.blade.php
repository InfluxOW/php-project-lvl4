@extends('layouts.app')

@section('content')

<h1 class="display-4 mb-5">Add New Task</h1>

{{ Form::open(['url' => route('tasks.store')]) }}
    @include('tasks._form')
    {{ Form::submit(__('Create'), ['class' => 'btn btn-primary btn-block']) }}
{{ Form::close() }}
@endsection('content')
