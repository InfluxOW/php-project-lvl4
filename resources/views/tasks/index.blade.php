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
            <th class="col-md-2">{{ __('Name') }}</th>
            <th class="col-md-2">{{ __('Status') }}</th>
            <th class="col-md-1">{{ __('Creator') }}</th>
            <th class="col-md-2">{{ __('Assignees') }}</th>
            <th class="col-md">{{ __('Created At') }}</th>
            @auth
                <th class="col-md-2">{{ __('Actions') }}</th>
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
                <td class="col-md-2">
                    <div class="badge badge-info">
                        {{ $task->status->name }}
                    </div>
                </td>
                <td class="col-md-1">
                    <a href="{{ route('users.show', $task->creator) }}">{{ $task->creator->name }}</a>
                </td>
                <td class="col-md-2">
                    @if ($task->assignees->count() >= 2)
                        <ul class="list-group list-group-flush">
                            @forelse ($task->assignees as $assignee)
                                <li class="list-group-item">
                                    <a href="{{ route('users.show', $assignee) }}">{{ $assignee->name }}</a>
                                </li>
                            @empty
                                <p>---------</p>
                            @endforelse
                        </ul>
                    @elseif ($task->assignees->count() === 1)
                        <a href="{{ route('users.show', $task->assignees->first()) }}">{{ $task->assignees->first()->name }}</a>
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
