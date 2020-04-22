@extends('layouts.app')

@section('content')

<h1 class="display-4">Add New Status</h1>

{{ Form::open(['url' => route('task_statuses.store'), 'class' => 'ui form']) }}
    @include('task_statuses._form')
    {{ Form::submit(__('Create'), ['class' => 'ui primary button fluid']) }}
{{ Form::close() }}
@endsection('content')
