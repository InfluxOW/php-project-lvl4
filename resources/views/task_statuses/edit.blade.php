@extends('layouts.app')

@section('content')

<h1 class="display-4 mb-5">{{ __('Edit Status') }}</h1>

{{ Form::open(['url' => route('task_statuses.update', $task_status), 'method' => 'PATCH']) }}
    @include('task_statuses._form')
    {{ Form::submit(__('Update'), ['class' => 'btn btn-primary btn-block']) }}
{{ Form::close() }}
@endsection('content')
