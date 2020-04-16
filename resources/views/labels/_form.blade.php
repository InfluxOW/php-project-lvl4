<x-errors/>

<div>
    <div class="field">
    {{ Form::label('name', __('Name')) }}
    {{ Form::text('name', $label->name ?? '', ['placeholder' => 'Name']) }}
    </div>
    <div class="field">
    {{ Form::label('description', __('Description')) }}
    {{ Form::textarea('description', $label->description ?? '', ['rows' => 3, 'placeholder' => 'Name']) }}
    </div>
    <div class="field">
    {{ Form::label('attention_level', __('Attention level')) }}
    {{ Form::select('attention_level', App\Label::ATTENTION_LEVEL, $label->attention_level ?? 2, ['class' => 'ui fluid selection dropdown custom-bottom']) }}
    </div>
</div>
