@extends('layouts.app')

@section('content')
<x-errors/>

    <table class="table text-center">
        <thead class="thead-light">
            <tr class="d-flex">
                <th class="col-md-1">#</th>
                <th class="col-md-3">Name</th>
                <th class="col-md-4">Description</th>
                <th class="col-md">Created At</th>
                @auth
                    <th class="col-md-2">Actions</th>
                @endauth
            </tr>
        </thead>
        <tbody class="section section-step">
            @foreach ($labels as $label)
                <tr class="d-flex font-weight-light">
                    <td class="col-md-1">{{ $label->id }}</td>
                    <td class="col-md-3">{{ $label->name }}</a></td>
                    <td class="col-md-4">{{ $label->description }}</a></td>
                    <td class="col-md">{{ $label->created_at }}</td>
                    @auth
                        <td class="col-md-2">
                            <div class="row">
                                <a href="{{ route('labels.edit', $label) }}" class="btn btn-primary col-6">{{ __('Edit') }}</a>
                                <a href="{{ route('labels.destroy', $label) }}" data-confirm="Are you sure?" data-method="delete" rel="nofollow" class="btn btn-primary col-6">{{ __('Delete') }}</a>
                            </div>
                        </td>
                    @endauth
                </tr>
            @endforeach
        </tbody>
    </table>
    @auth
        <a href="{{ route('labels.create') }}" class="btn btn-primary btn-sm btn-block" role="button" aria-pressed="true">{{ __('Add label') }}</a>
    @endauth

    <div class="mt-2">{{$labels->links()}}</div>
@endsection('content')
