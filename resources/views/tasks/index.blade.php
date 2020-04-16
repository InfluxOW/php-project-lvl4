@extends('layouts.app')

@section('content')
<x-errors/>

<div>
    @include('tasks._filter-form')
    @auth
        <a href="{{ route('tasks.create') }}" class="ui positive button mb-3 ml-auto" role="button" aria-pressed="true">{{ __('Add task') }}</a>
    @endauth
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
                    <div class="badge badge-info">
                        {{ $task->status->name }}
                    </div>
                </td>
                <td>
                    {{ $task->creator->name }}
                </td>
                <td>
                    @if ($task->assignees->count() >= 2)
                        <ul class="list-group list-group-flush">
                            @forelse ($task->assignees as $assignee)
                                <li class="list-group-item">
                                    {{ $assignee->name }}
                                </li>
                            @empty
                                <p>---------</p>
                            @endforelse
                        </ul>
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

<div class="ui floated pagination menu mb-3">
    {{ $tasks->links('pagination::semantic-ui') }}
</div>
@endsection('content')
