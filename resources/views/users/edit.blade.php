@extends('layouts.app')

@section('content')
<x-errors/>
{{ Form::model($user, ['url' => route('users.update', compact('user')), 'files' => true, 'method' => 'PATCH', 'class' => 'ui form']) }}
    <div class="ui two column grid">
        <div class="six wide column">
            <div class="field">
                <div class="ui centered fluid card">
                    <div class="ui image avatar-user centered">
                        <img src="{{ isset($user->image) ? $user->image->url : "https://udemy-project-1.s3.eu-west-3.amazonaws.com/avatars/default-user-image.png" }}">
                    </div>
                        <label for="embedpollfileinput" class="ui green centered button">
                            <i class="ui upload icon"></i>{{ __('Upload avatar') }}
                        </label>
                        {{ Form::file('avatar', ['class' => 'inputfile', 'id' => 'embedpollfileinput']) }}
                </div>
            </div>
        </div>
        <div class="ten wide column">
            <div class="field">
                <div class="font-grey">{{ Form::label('name', __('Name'), ['class' => 'zero-bottom']) }}</div>
                {{ Form::text('name', $user->name ?? '', ['placeholder' => __('Name')]) }}
            </div>
        </div>
    </div>
    <div class="custom-top">
        {{ Form::submit(__('Save changes'), ['class' => 'ui primary button fluid']) }}
    </div>
{{ Form::close() }}
@endsection('content')
