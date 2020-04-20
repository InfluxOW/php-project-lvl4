@extends('layouts.app')

@section('content')
<x-errors/>
    <div class="row">
        <div class="col-8">
            <h6 class="text-center lead">Tasks in which user is involved</h6>
            <hr>
            <table class="table text-center mt-2">
                <thead class="thead-light">
                    <tr class="d-flex">
                        <th class="col-md-1">#</th>
                        <th class="col-md-2">Name</th>
                        <th class="col-md-5">Description</th>
                        <th class="col-md-2">Status</th>
                        <th class="col-md-2">Created At</th>
                    </tr>
                </thead>
                <tbody class="section section-step">
                    @foreach ($user->assignedTasks as $task)
                        <tr class="d-flex font-weight-light">
                            <td class="col-md-1">{{ $task->id }}</td>
                            <td class="col-md-2">
                                <a href="{{ route('tasks.show', compact('task')) }}">{{ $task->name }}</a>
                            </td>
                            <td class="col-md-5">{{ $task->description }}</td>
                            <td class="col-md-2">
                                <div class="badge badge-info">
                                    {{ $task->status->name }}
                                </div>
                            </td>
                            <td class="col-md-2">{{ $task->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-4 text-center">
            <h3>{{ $user->name }}</h3>
            <img src="{{ isset($user->image) ? $user->image->url : 'https://udemy-project-1.s3.eu-west-3.amazonaws.com/avatars/default-user-image.png' }}" class="img-thumbnail avatar">
            <p>
                Completed tasks count: {{ count($user->assignedTasks()->withTrashed()->completedTasks()->get()) }}
            </p>
        </div>
    </div>
@endsection('content')
