@extends('layouts.app')

@section('content')

<h1 class="display-4 mb-5">{{ __('Add New Label') }}</h1>

{{ Form::open(['url' => route('labels.store')]) }}
    @include('labels._form')
    {{ Form::submit(__('Create'), ['class' => 'btn btn-primary btn-block']) }}
{{ Form::close() }}
@endsection('content')
