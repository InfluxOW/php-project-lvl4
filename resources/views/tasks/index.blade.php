@extends('layouts.app')

@section('content')
<x-errors/>

<div>
    <div class="ui basic segment">
        @auth
            <a href="{{ route('tasks.create') }}" class="ui positive button fluid" aria-pressed="true">{{ __('Add task') }}</a>
            <div class="ui horizontal divider">Or</div>
        @endauth
        @include('tasks._filter-form')
    </div>
</div>
<div class="zero-top custom-bottom">
    <table class="ui blue striped table center aligned">
        <thead>
            <tr>
                <th class="one wide">#</th>
                <th class="two wide">{{ __('Name') }}</th>
                <th class="two wide">{{ __('Status') }}</th>
                <th class="two wide">{{ __('Creator') }}</th>
                <th class="four wide">{{ __('Assignees') }}</th>
                <th class="two wide">{{ __('Created At') }}</th>
                @auth
                    <th class="two wide">{{ __('Actions') }}</th>
                @endauth
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>
                        <a href="{{ route('tasks.show', compact('task')) }}">{{ $task->name }}</a>
                    </td>
                    <td>
                        <a class="ui small blue label">
                            {{ $task->status->name }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('users.show', $task->creator) }}">{{ $task->creator->name }}</a>
                    </td>
                    <td>
                        @if ($task->assignees->count() >= 2)
                            <div class="ui relaxed divided list">
                                @forelse ($task->assignees as $assignee)
                                    <div class="item">
                                        <a href="{{ route('users.show', $assignee) }}">{{ $assignee->name }}</a>
                                    </div>
                                @empty
                                    <p>---------</p>
                                @endforelse
                            </d>
                        @elseif ($task->assignees->count() === 1)
                        <a href="{{ route('users.show', $task->assignees->first()) }}">{{ $task->assignees->first()->name }}</a>
                        @else
                            ---------
                        @endif
                    </td>
                    <td>{{ $task->created_at }}</td>
                    @auth
                        <td>
                            <div class="two ui buttons">
                                <a href="{{ route('tasks.edit', $task) }}" class="ui primary button">{{ __('Edit') }}</a>
                                @can('delete', $task)
                                    <a href="{{ route('tasks.destroy', $task) }}" data-confirm="{{ __("Are you sure?") }}" data-method="delete" rel="nofollow" class="ui button">{{ __('Delete') }}</a>
                                @endcan
                            </div>
                        </td>
                    @endauth
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- 10 is number of items per page --}}
@if (count(App\Task::all()) > 10)
    <div class="ui floated pagination menu">
        {{ $tasks->links('pagination::semantic-ui') }}
    </div>
@endif

@endsection('content')
