@extends('layouts.app')

@section('content')
<x-errors/>
    <div class="row">
        <div class="col-8">
            {{-- <x-comment-form :route="route('users.comments.store', compact('user'))"/> --}}
            {{-- <x-comment-list :comments="$user->comments()->with('user', 'tags')->paginate(5)"/> --}}
        </div>
        <div class="col-4 text-center">
            <h3>{{ $user->name }}</h3>
            <img src="{{ isset($user->image) ? $user->image->url : 'https://udemy-project-1.s3.eu-west-3.amazonaws.com/avatars/default-user-image.png' }}" class="img-thumbnail avatar">
        </div>
    </div>
@endsection('content')
