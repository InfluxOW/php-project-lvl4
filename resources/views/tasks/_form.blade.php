<x-errors/>

<div class="text-muted">
    {{ Form::label('name', __('Name'), ['class' => 'font-weight-normal my-1']) }}<br>
    {{ Form::text('name', $task->name ?? '', ['class' => 'form-control']) }}<br>
    {{ Form::label('description', __('Description'), ['class' => 'form-group font-weight-normal my-1']) }}<br>
    {{ Form::textarea('description', $task->description ?? '', ['class' => 'form-control', 'rows' => 3]) }}<br>
    {{ Form::label('status_id', __('Status'), ['class' => 'form-group font-weight-normal my-1']) }}<br>
    {{ Form::select('status_id', $statuses, $task->status->id ?? '', ['class' => 'form-control mb-4']) }}
    {{ Form::label('assignees', __('Assignees'), ['class' => 'form-group font-weight-normal my-1']) }}<br>
    {{ Form::select('assignees[]', $users, null, ['class' => 'form-control mb-4', 'multiple' => 'multiple'])  }}
</div>


