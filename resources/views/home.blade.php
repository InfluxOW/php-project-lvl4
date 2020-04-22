@extends('layouts.app')

@section('content')
<div class="jumbotron helvetica bigger-font">
    <h1 class="display-4 helvetica">{{ __("Task Manager") }}</h1>
    <p class="lead">{{ __('Simple implementation of typical task manager') }}</p>
    <hr class="my-4">
    <p>{{ __("Your to-do's have never been simplier and more convenient!") }}</p>
    <p class="lead">
        <a class="huge ui primary button" href="{{ route('tasks.index') }}" role="button">{{ __('Create your own task') }}</a>
    </p>
</div>
@endsection
