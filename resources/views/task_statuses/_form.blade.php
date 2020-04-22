<x-errors/>

<div class="field">
    <div class="font-grey">{{ Form::label('name', __('Name'), ['class' => 'zero-bottom']) }}</div>
    {{ Form::text('name', $task_status->name ?? '', ['placeholder' => 'Name']) }}
</div>
