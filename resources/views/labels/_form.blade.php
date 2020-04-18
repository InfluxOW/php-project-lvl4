<x-errors/>

<div>
    <div class="field">
        <div class="font-grey">{{ Form::label('name', __('Name'), ['class' => 'zero-bottom']) }}</div>
    {{ Form::text('name', $label->name ?? '', ['placeholder' => 'Name']) }}
    </div>
    <div class="field">
        <div class="font-grey">{{ Form::label('description', __('Description'), ['class' => 'zero-bottom']) }}</div>
    {{ Form::textarea('description', $label->description ?? '', ['rows' => 3, 'placeholder' => 'Name']) }}
    </div>
    <div class="field">
        <div class="font-grey">{{ Form::label('attention_level', __('Attention level'), ['class' => 'zero-bottom']) }}</div>
    {{ Form::select('attention_level', App\Label::ATTENTION_LEVEL, $label->attention_level ?? 2, ['class' => 'ui fluid selection dropdown custom-bottom']) }}
    </div>
</div>
