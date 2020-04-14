@extends('layouts.app')

@section('content')
<x-errors/>

    <table class="table text-center">
        <thead class="thead-light">
            <tr class="d-flex">
                <th class="col-md-1">#</th>
                <th class="col-md">Name</th>
                <th class="col-md">Created At</th>
                @auth
                    <th class="col-md">Actions</th>
                @endauth
            </tr>
        </thead>
        <tbody class="section section-step">
            @foreach ($statuses as $status)
                <tr class="d-flex font-weight-light">
                    <td class="col-md-1">{{ $status->id }}</td>
                    <td class="col-md">{{ $status->name }}</a></td>
                    <td class="col-md">{{ $status->created_at }}</td>
                    @auth
                        <td class="col-md">
                            <a href="{{ route('statuses.edit', $status) }}" class="btn btn-primary">{{ __('Edit') }}</a>
                            @if (!$status->trashed())
                                <a href="{{ route('statuses.destroy', $status) }}" data-confirm="Are you sure?" data-method="delete" rel="nofollow" class="btn btn-primary">{{ __('Delete') }}</a>
                            @endif
                        </td>
                    @endauth
                </tr>
            @endforeach
        </tbody>
    </table>
    @auth
        <a href="{{ route('statuses.create') }}" class="btn btn-primary btn-sm btn-block" role="button" aria-pressed="true">{{ __('Add status') }}</a>
    @endauth

    <div>{{$statuses->links()}}</div>
@endsection('content')
