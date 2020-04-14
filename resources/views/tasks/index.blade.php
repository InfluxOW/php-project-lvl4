@extends('layouts.app')

@section('content')
<x-errors/>
@auth
    <a href="{{ route('tasks.create') }}" class="btn btn-primary btn-sm btn-block mb-3" role="button" aria-pressed="true">{{ __('Add task') }}</a>
@endauth
    <table class="table text-center self-content-center">
        <thead class="thead-light">
            <tr>
                <th class="col-md-1 align-middle">#</th>
                <th class="col-md-2 align-middle">Name</th>
                <th class="col-md-3 align-middle">Description</th>
                <th class="col-md-1 align-middle">Status</th>
                <th class="col-md-1 align-middle">Creator</th>
                <th class="col-md-2 align-middle">Assignees</th>
                <th class="col-md-1 align-middle">Created At</th>
                @auth
                    <th class="col-md align-middle">Actions</th>
                @endauth
            </tr>
        </thead>
        <tbody class="section section-step">
            @foreach ($tasks as $task)
                <tr class="font-weight-light">
                    <td class="col-md-1 align-middle">{{ $task->id }}</td>
                    <td class="col-md-2 align-middle">
                        <a href="{{ route('tasks.show', compact('task')) }}">{{ $task->name }}</a>
                    </td>
                    <td class="col-md-3 align-middle">{{ $task->description }}</td>
                    <td class="col-md-1 align-middle">{{ $task->status->name }}</td>
                    <td class="col-md-1 align-middle">{{ $task->creator->name }}</td>
                    <td class="col-md-2 align-middle">
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
                    <td class="col-md-1 align-middle">{{ $task->created_at }}</td>
                    @auth
                    <div class="row">
                        <td class="col-md align-middle">
                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary col-12">{{ __('Edit') }}</a>
                            @can('delete', $task)
                                @if (!$task->trashed())
                                    <a href="{{ route('tasks.destroy', $task) }}" data-confirm="Are you sure?" data-method="delete" rel="nofollow" class="btn btn-primary col-12 mt-2">{{ __('Delete') }}</a>
                                @endif
                            @endcan
                        </td>
                    </div>
                    @endauth
                </tr>
            @endforeach
        </tbody>
    </table>

    <div>{{$tasks->links()}}</div>
@endsection('content')
