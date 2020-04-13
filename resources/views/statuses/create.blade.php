@extends('layouts.app')

@section('content')

<h1 class="display-4 mb-5">Add New Status</h1>

{{ Form::open(['url' => route('statuses.store')]) }}
    @include('statuses._form')
    {{ Form::submit(__('Create'), ['class' => 'btn btn-primary btn-block']) }}
{{ Form::close() }}
@endsection('content')
