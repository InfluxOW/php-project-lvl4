@forelse ($labels as $label)
    @switch($label->attention_level)
        @case(1)
            <a class="ui green label">
            @break
        @case(2)
            <a class="ui grey label">
            @break
        @case(3)
            <a class="ui blue label">
            @break
        @case(4)
            <a class="ui yellow label">
            @break
        @case(5)
            <a class="ui red label">
            @break
    @endswitch
        {{ $label->name }}
    </a>
@empty
    <div><small>{{ __('No labels!') }}</small></div>
@endforelse
