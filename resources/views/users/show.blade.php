@extends('layouts.app')

@section('content')
<x-errors/>
<div class="ui two column centered grid">
    <div class="row">
        <div class="ten wide column">
            <h4 class="ui center aligned header">
                {{ __('Tasks in which the user is involved') }}
            </h4>
            <hr>
            <div class="zero-top custom-bottom">
                <table class="ui orange striped compact table center aligned">
                    <thead class="full-width">
                        <tr>
                            <th class="one wide">#</th>
                            <th class="three wide">{{ __('Name') }}</th>
                            <th class="six wide">{{ __('Description') }}</th>
                            <th class="two wide">{{ __('Status') }}</th>
                            <th class="four wide">{{ __('Created At') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user->assignedTasks->load('status') as $task)
                            <tr>
                                <td>{{ $task->id }}</td>
                                <td>
                                    <a href="{{ route('tasks.show', compact('task')) }}">{{ $task->name }}</a>
                                </td>
                                <td>
                                    {{ $task->description }}
                                </td>
                                <td>
                                    <a class="ui small blue label">
                                        {{ $task->status->name }}
                                    </a>
                                </td>
                                <td>{{ $task->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="six wide column">
            <h3 class="ui centered header">{{ $user->name }}</h3>
            <img src="{{ isset($user->image) ? $user->image->url : 'https://udemy-project-1.s3.eu-west-3.amazonaws.com/avatars/default-user-image.png' }}" class="ui centered bordered small image">
            <div class="ui center aligned basic segment">
                {{ __('Completed tasks count') }}: {{ count($user->assignedTasks()->withTrashed()->completed()->get()) }}
                </div>
        </div>
    </div>
</div>
@endsection('content')
