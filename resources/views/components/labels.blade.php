@forelse ($labels as $label)
    @switch($label->attention_level)
        @case(1)
            <div class="badge badge-success">
            @break
        @case(2)
            <div class="badge badge-primary">
            @break
        @case(3)
            <div class="badge badge-info">
            @break
        @case(4)
            <div class="badge badge-warning">
            @break
        @case(5)
            <div class="badge badge-danger">
            @break
    @endswitch
        {{ $label->name }}
    </div>
@empty
    <div class="font-weight-light"><small>{{ __('No labels!') }}</small></div>
@endforelse
