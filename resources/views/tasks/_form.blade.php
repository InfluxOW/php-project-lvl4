<x-errors/>
<div>
    <div class="field">
    {{ Form::label('name', __('Name')) }}
    {{ Form::text('name', $task->name ?? '', ['placeholder' => 'Name']) }}
    </div>
    <div class="field">
    {{ Form::label('description', __('Description')) }}
    {{ Form::textarea('description', $task->description ?? '', ['rows' => 3, 'placeholder' => 'Description']) }}
    </div>
    <div class="field">
    {{ Form::label('status_id', __('Status')) }}
    {{ Form::select('status_id', $statuses, $task->status->id ?? $statusNew, ['class' => 'ui fluid selection dropdown']) }}
    </div>
    <div class="field">
    {{ Form::label('assignees', __('Assignees')) }}
    {{ Form::select('assignees[]', $users, $task->assignees->pluck('id')->toArray(), ['class' => 'ui fluid selection dropdown', 'multiple' => '', 'placeholder' => 'Assignees'])  }}
    </div>
    <div class="field">
    {{ Form::label('labels', __('Labels')) }}
    {{ Form::select('labels[]', $labels, $task->labels->pluck('id')->toArray(), ['class' => 'ui fluid selection dropdown custom-bottom', 'multiple' => '', 'placeholder' => 'Labels'])  }}
    </div>
</div>

