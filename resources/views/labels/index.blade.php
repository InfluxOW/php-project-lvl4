@extends('layouts.app')

@section('content')
<x-errors/>

<div class="custom-bottom">
    <table class="ui grey striped table text-center">
        <thead>
            <tr>
                <th class="one wide">#</th>
                <th class="two wide">Name</th>
                <th class="seven wide">Description</th>
                <th class="two wide">Created At</th>
                @auth
                    <th class="four wide">Actions</th>
                @endauth
            </tr>
        </thead>
        <tbody>
            @foreach ($labels as $label)
                <tr>
                    <td>{{ $label->id }}</td>
                    <td>{{ $label->name }}</td>
                    <td>{{ $label->description }}</td>
                    <td>{{ $label->created_at }}</td>
                    @auth
                        <td>
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
</div>

    @auth
        <div class="custom-bottom">
            <a href="{{ route('labels.create') }}" class="ui positive basic button fluid" role="button" aria-pressed="true">{{ __('Add label') }}</a>
        </div>
    @endauth

    @if (count(App\Status::all()) > 5)
        <div class="ui floated pagination menu">
            {{ $labels->links('pagination::semantic-ui') }}
        </div>
    @endif

@endsection('content')
