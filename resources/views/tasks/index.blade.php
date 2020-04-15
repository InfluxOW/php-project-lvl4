@extends('layouts.app')

@section('content')
<x-errors/>
<div class="d-flex">
    @include('tasks._filter-form')
    @auth
        <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3 ml-auto" role="button" aria-pressed="true">{{ __('Add task') }}</a>
    @endauth
</div>

<table class="table text-center mt-2">
    <thead class="thead-light">
        <tr class="d-flex">
            <th class="col-md-1">#</th>
            <th class="col-md-2">Name</th>
            <th class="col-md-1">Status</th>
            <th class="col-md-1">Creator</th>
            <th class="col-md-3">Assignees</th>
            <th class="col-md">Created At</th>
            @auth
                <th class="col-md-2">Actions</th>
            @endauth
        </tr>
    </thead>
    <tbody class="section section-step">
        @foreach ($tasks as $task)
            <tr class="d-flex font-weight-light">
                <td class="col-md-1">{{ $task->id }}</td>
                <td class="col-md-2">
                    <a href="{{ route('tasks.show', compact('task')) }}">{{ $task->name }}</a>
                </td>
                <td class="col-md-1">
                    <div class="badge badge-info">
                        {{ $task->status->name }}
                    </div>
                </td>
                <td class="col-md-1">
                    {{ $task->creator->name }}
                </td>
                <td class="col-md-3">
                    @if ($task->assignees->count() > 2)
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
                <td class="col-md">{{ $task->created_at }}</td>
                @auth
                    <td class="col-md-2">
                        <div class="row">
                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary col-6">{{ __('Edit') }}</a>
                            @can('delete', $task)
                                <a href="{{ route('tasks.destroy', $task) }}" data-confirm="Are you sure?" data-method="delete" rel="nofollow" class="btn btn-primary col-6">{{ __('Delete') }}</a>
                            @endcan
                        </div>
                    </td>
                @endauth
            </tr>
        @endforeach
    </tbody>
</table>

<div>{{$tasks->links()}}</div>
@endsection('content')
