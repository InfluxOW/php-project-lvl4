@extends('layouts.app')

@section('content')

<h1 class="display-4">{{ __('Edit Label') }}</h1>

{{ Form::open(['url' => route('labels.update', $label), 'method' => 'PATCH', 'class' => 'ui form']) }}
    @include('labels._form')
    {{ Form::submit(__('Update'), ['class' => 'ui primary button fluid']) }}
{{ Form::close() }}
@endsection('content')
