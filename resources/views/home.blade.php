@extends('layouts.app')

@section('content')
<div class="jumbotron">
    <h1 class="display-4">{{ __("Task Manager") }}</h1>
    <p class="lead">{{ __('Simple implementation of typical task manager') }}</p>
    <hr class="my-4">
    <p>{{ "Your to-do's have never been simplier and more convenient!" }}</p>
    <p class="lead">
        <a class="huge ui primary button" href="{{ route('tasks.index') }}" role="button">Create your own task</a>
      </p>
  </div>
@endsection
