@extends('layouts.app')

@section('content')

<h1 class="display-4 mb-5">Edit Status</h1>

{{ Form::open(['url' => route('statuses.update', $status), 'method' => 'PATCH']) }}
    @include('statuses._form')
    {{ Form::submit(__('Update'), ['class' => 'btn btn-primary btn-block']) }}
{{ Form::close() }}
@endsection('content')
