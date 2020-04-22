<x-errors/>
<div>
    <div class="field">
        <div class="font-grey">{{ Form::label('name', __('Name'), ['class' => 'zero-bottom']) }}</div>
    {{ Form::text('name', $task->name ?? '', ['placeholder' => __('Name')]) }}
    </div>
    <div class="field">
        <div class="font-grey">{{ Form::label('description', __('Description'), ['class' => 'zero-bottom']) }}</div>
    {{ Form::textarea('description', $task->description ?? '', ['rows' => 3, 'placeholder' => __('Description')]) }}
    </div>
    <div class="field">
        <div class="font-grey">{{ Form::label('status_id', __('Status'), ['class' => 'zero-bottom']) }}</div>
    {{ Form::select('status_id', $statuses, $task->status->id ?? $statusNew, ['class' => 'ui fluid selection dropdown']) }}
    </div>
    <div class="field">
        <div class="font-grey">{{ Form::label('assignees', __('Assignees'), ['class' => 'zero-bottom']) }}</div>
    {{ Form::select('assignees[]', $users, $task->assignees->pluck('id')->toArray(), ['class' => 'ui fluid selection dropdown', 'multiple' => '', 'placeholder' => __('Assignees')])  }}
    </div>
    <div class="field">
        <div class="font-grey">{{ Form::label('labels', __('Labels'), ['class' => 'zero-bottom']) }}</div>
    {{ Form::select('labels[]', $labels, $task->labels->pluck('id')->toArray(), ['class' => 'ui fluid selection dropdown custom-bottom', 'multiple' => '', 'placeholder' => __('Labels')])  }}
    </div>
</div>

