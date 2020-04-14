@extends('layouts.app')

@section('content')
<x-errors/>
@auth
    <a href="{{ route('tasks.create') }}" class="btn btn-primary btn-sm btn-block mb-3" role="button" aria-pressed="true">{{ __('Add task') }}</a>
@endauth

<table class="table text-center">
    <thead class="thead-light">
        <tr class="d-flex">
            <th class="col-md-1">#</th>
            <th class="col-md-2">Name</th>
            <th class="col-md-1">Status</th>
            <th class="col-md-1">Creator</th>
            <th class="col-md-3">Assignees</th>
            <th class="col-md-2">Created At</th>
            @auth
                <th class="col-md-2">Actions</th>
            @endauth
        </tr>
    </thead>
    <tbody class="section section-step">
        @foreach ($tasks as $task)
            <tr class="d-flex font-weight-light">
                <td class="col-md-1 align-middle">{{ $task->id }}</td>
                <td class="col-md-2 align-middle">
                    <a href="{{ route('tasks.show', compact('task')) }}">{{ $task->name }}</a>
                </td>
                <td class="col-md-1 align-middle">
                    <div class="badge badge-info">
                        {{ $task->status->name }}
                    </div>
                </td>
                <td class="col-md-1 align-middle">{{ $task->creator->name }}</td>
                <td class="col-md-3 align-middle">
                    <ul class="list-group list-group-flush">
                        @forelse ($task->assignees as $assignee)
                        <li class="list-group-item">
                            {{ $assignee->name }}
                        </li>
                        @empty
                            <p>---------</p>
                        @endforelse
                    </ul>
                </td>
                <td class="col-md-2 align-middle">{{ $task->created_at }}</td>
                @auth
                    <td class="col-md-2 align-middle">
                        <div class="row">
                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary col-6">{{ __('Edit') }}</a>
                            @can('delete', $task)
                                @if (!$task->trashed())
                                    <a href="{{ route('tasks.destroy', $task) }}" data-confirm="Are you sure?" data-method="delete" rel="nofollow" class="btn btn-primary col-6">{{ __('Delete') }}</a>
                                @endif
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
