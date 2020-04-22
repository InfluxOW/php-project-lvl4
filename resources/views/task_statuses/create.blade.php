@extends('layouts.app')

@section('content')

<h1 class="display-4 mb-5">{{ __('Add New Status') }}</h1>

{{ Form::open(['url' => route('task_statuses.store')]) }}
    @include('task_statuses._form')
    {{ Form::submit(__('Create'), ['class' => 'btn btn-primary btn-block']) }}
{{ Form::close() }}
@endsection('content')
