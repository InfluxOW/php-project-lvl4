@extends('layouts.app')

@section('content')
<x-errors/>

    <table class="ui green striped table text-center">
        <thead>
            <tr>
                <th class="two wide">#</th>
                <th class="five wide">Name</th>
                <th class="five wide">Created At</th>
                @auth
                    <th class="four wide">Actions</th>
                @endauth
            </tr>
        </thead>
        <tbody>
            @foreach ($statuses as $status)
            <div class="middle aligned grid">
                <tr>
                    <td>{{ $status->id }}</td>
                    <td>{{ $status->name }}</a></td>
                    <td>{{ $status->created_at }}</td>
                    @auth
                        <td>
                            <div class="two ui buttons">
                                <a href="{{ route('statuses.edit', $status) }}" class="ui primary button"">{{ __('Edit') }}</a>
                                <a href="{{ route('statuses.destroy', $status) }}" data-confirm="Are you sure?" data-method="delete" rel="nofollow" class="ui button">{{ __('Delete') }}</a>
                            </div>
                        </td>
                    @endauth
                </tr>
            </div>
            @endforeach
        </tbody>
    </table>
    @auth
        <a href="{{ route('statuses.create') }}" class="ui positive basic button fluid" role="button" aria-pressed="true">{{ __('Add status') }}</a>
    @endauth

    @if (count(App\Status::all()) > 5)
    <div class="custom-top">
        <div class="ui floated pagination menu">
            {{ $statuses->links('pagination::semantic-ui') }}
        </div>
    </div>
    @endif

@endsection('content')
