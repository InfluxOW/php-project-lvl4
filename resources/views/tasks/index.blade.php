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

<table class="ui blue striped table text-center mt-2">
    <thead>
        <tr>
            <th class="one wide">#</th>
            <th class="two wide">Name</th>
            <th class="two wide">Status</th>
            <th class="two wide">Creator</th>
            <th class="four wide">Assignees</th>
            <th class="two wide">Created At</th>
            @auth
                <th class="two wide">Actions</th>
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
                    {{ $task->creator->name }}
                </td>
                <td>
                    @if ($task->assignees->count() >= 2)
                        <div class="ui relaxed divided list">
                            @forelse ($task->assignees as $assignee)
                                <div class="item">
                                    {{ $assignee->name }}
                                </div>
                            @empty
                                <p>---------</p>
                            @endforelse
                        </d>
                    @elseif ($task->assignees->count() === 1)
                        {{ $task->assignees->first()->name }}
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
                                    <a href="{{ route('tasks.destroy', $task) }}" data-confirm="Are you sure?" data-method="delete" rel="nofollow" class="ui button">{{ __('Delete') }}</a>
                                @endcan
                            </div>
                    </td>
                @endauth
            </tr>
        @endforeach
    </tbody>
</table>

<div class="ui floated pagination menu">
    {{ $tasks->links('pagination::semantic-ui') }}
</div>

@endsection('content')
