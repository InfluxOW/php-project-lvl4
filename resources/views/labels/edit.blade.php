@extends('layouts.app')

@section('content')

<h1 class="display-4 mb-5">Edit Label</h1>

{{ Form::open(['url' => route('labels.update', $label), 'method' => 'PATCH']) }}
    @include('labels._form')
    {{ Form::submit(__('Update'), ['class' => 'btn btn-primary btn-block']) }}
{{ Form::close() }}
@endsection('content')
