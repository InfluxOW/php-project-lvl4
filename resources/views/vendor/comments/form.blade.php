

<div class="custom-bottom">
    <div class="ui one column grid">
        <div class="column">
            <div class="ui fluid card">
                <div class="content">
                    {{ Form::open(['url' => route('comments.store'), 'method' => 'POST', 'class' => 'ui reply form error'])  }}
                        {{ Form::hidden('commentable_encrypted_key', $model->getEncryptedKey()) }}
                        <div class="field">
                            <div class="font-grey">{{ Form::label('message', __('Enter your message here:'), ['class' => 'zero-bottom']) }}</div>
                            {{ Form::textarea('message', '', ['rows' => 3]) }}
                        </div>
                        {{ Form::submit("Add comment", ['class' => 'ui primary submit button']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
