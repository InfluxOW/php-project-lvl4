@extends('layouts.app')

@section('content')

<h1 class="display-4">{{ __('Add New Label') }}</h1>

{{ Form::open(['url' => route('labels.store'), 'class' => 'ui form']) }}
    @include('labels._form')
    {{ Form::submit(__('Create'), ['class' => 'ui primary button fluid']) }}
{{ Form::close() }}
@endsection('content')
