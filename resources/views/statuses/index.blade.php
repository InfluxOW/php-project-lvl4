@extends('layouts.app')

@section('content')
<x-errors/>

    <table class="table text-center">
        <thead class="thead-light">
            <tr class="d-flex">
                <th class="col-md-1">#</th>
                <th class="col-md-3">Name</th>
                <th class="col-md">Created At</th>
                @auth
                    <th class="col-md-2">Actions</th>
                @endauth
            </tr>
        </thead>
        <tbody class="section section-step">
            @foreach ($statuses as $status)
                <tr class="d-flex font-weight-light">
                    <td class="col-md-1">{{ $status->id }}</td>
                    <td class="col-md-3">{{ $status->name }}</a></td>
                    <td class="col-md">{{ $status->created_at }}</td>
                    @auth
                        <td class="col-md-2">
                            <div class="row">
                                <a href="{{ route('statuses.edit', $status) }}" class="btn btn-primary col-6">{{ __('Edit') }}</a>
                                <a href="{{ route('statuses.destroy', $status) }}" data-confirm="Are you sure?" data-method="delete" rel="nofollow" class="btn btn-primary col-6">{{ __('Delete') }}</a>
                            </div>
                        </td>
                    @endauth
                </tr>
            @endforeach
        </tbody>
    </table>
    @auth
        <a href="{{ route('statuses.create') }}" class="btn btn-primary btn-sm btn-block" role="button" aria-pressed="true">{{ __('Add status') }}</a>
    @endauth

    <div class="mt-2">{{$statuses->links()}}</div>
@endsection('content')
