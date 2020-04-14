<x-errors/>

<div class="text-muted">
    {{ Form::label('name', __('Name'), ['class' => 'font-weight-normal my-1']) }}<br>
    {{ Form::text('name', $label->name ?? '', ['class' => 'form-control']) }}<br>
    {{ Form::label('description', __('Description'), ['class' => 'form-group font-weight-normal my-1']) }}<br>
    {{ Form::textarea('description', $label->description ?? '', ['class' => 'form-control', 'rows' => 3]) }}<br>
    {{ Form::label('attention_level', __('Attention level'), ['class' => 'form-group font-weight-normal my-1']) }}<br>
    {{ Form::select('attention_level', App\Label::ATTENTION_LEVEL, $label->attention_level ?? 2, ['class' => 'form-control mb-4']) }}
</div>
