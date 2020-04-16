@foreach (session('flash_notification', collect())->toArray() as $message)
<div class="custom-top">
        <div class="ui message {{ flashMessageLevelToSemanticUi($message['level']) }} {{ $message['important'] ? 'important' : '' }}" role="alert">
            @if ($message['important'])
                <i class="close icon"></i>
            @endif

            {!! $message['message'] !!}
        </div>
</div>
@endforeach

{{ session()->forget('flash_notification') }}
