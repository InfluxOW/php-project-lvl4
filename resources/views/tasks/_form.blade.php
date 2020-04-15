<x-errors/>
<div class="text-muted">
    {{ Form::label('name', __('Name'), ['class' => 'font-weight-normal my-1']) }}<br>
    {{ Form::text('name', $task->name ?? '', ['class' => 'form-control']) }}<br>
    {{ Form::label('description', __('Description'), ['class' => 'form-group font-weight-normal my-1']) }}<br>
    {{ Form::textarea('description', $task->description ?? '', ['class' => 'form-control', 'rows' => 3]) }}<br>
    {{ Form::label('status_id', __('Status'), ['class' => 'form-group font-weight-normal my-1']) }}<br>
    {{ Form::select('status_id', $statuses, $task->status->id ?? $statusNew, ['class' => 'form-control mb-4 selectpicker']) }}
    {{ Form::label('assignees', __('Assignees'), ['class' => 'form-group font-weight-normal my-1']) }}<br>
    {{ Form::select('assignees[]', $users, $task->assignees->pluck('id')->toArray(), ['class' => 'form-control mb-4 selectpicker', 'multiple'])  }}
    {{ Form::label('labels', __('Labels'), ['class' => 'form-group font-weight-normal my-1']) }}<br>
    {{ Form::select('labels[]', $labels, $task->labels->pluck('id')->toArray(), ['class' => 'form-control mb-4 selectpicker', 'multiple'])  }}
</div>


