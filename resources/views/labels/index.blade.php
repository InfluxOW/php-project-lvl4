@extends('layouts.app')

@section('content')
<x-errors/>

    <table class="ui grey striped table text-center">
        <thead>
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
        <tbody>
            @foreach ($labels as $label)
                <tr class="d-flex font-weight-light">
                    <td class="col-md-1">{{ $label->id }}</td>
                    <td class="col-md-3">{{ $label->name }}</a></td>
                    <td class="col-md-4">{{ $label->description }}</a></td>
                    <td class="col-md">{{ $label->created_at }}</td>
                    @auth
                        <td class="col-md-2">
                            <div class="two ui buttons">
                                <a href="{{ route('labels.edit', $label) }}" class="ui primary button"">{{ __('Edit') }}</a>
                                <a href="{{ route('labels.destroy', $label) }}" data-confirm="Are you sure?" data-method="delete" rel="nofollow" class="ui button">{{ __('Delete') }}</a>
                            </div>
                        </td>

                    @endauth
                </tr>
            @endforeach
        </tbody>
    </table>
    @auth
    <div class="two ui buttons">
        <a href="{{ route('labels.create') }}" class="ui positive basic button" role="button" aria-pressed="true">{{ __('Add status') }}</a>
    </div>
    @endauth

    <div class="ui floated pagination menu mt-2">
        {{ $labels->links('pagination::semantic-ui') }}
    </div>
@endsection('content')
