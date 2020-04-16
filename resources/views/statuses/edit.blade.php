@extends('layouts.app')

@section('content')

<h1 class="display-4">Edit Status</h1>

{{ Form::open(['url' => route('statuses.update', $status), 'method' => 'PATCH', 'class' => 'ui form']) }}
    @include('statuses._form')
    {{ Form::submit(__('Update'), ['class' => 'ui primary button fluid']) }}
{{ Form::close() }}
@endsection('content')
