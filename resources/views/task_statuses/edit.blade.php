@extends('layouts.app')

@section('content')

<h1 class="display-4">Edit Status</h1>

{{ Form::open(['url' => route('task_statuses.update', $task_status), 'method' => 'PATCH', 'class' => 'ui form']) }}
    @include('task_statuses._form')
    {{ Form::submit(__('Update'), ['class' => 'ui primary button fluid']) }}
{{ Form::close() }}
@endsection('content')
