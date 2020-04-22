<x-errors/>

<div class="text-muted">
    {{ Form::label('name', __('Name'), ['class' => 'font-weight-normal']) }}<br>
    {{ Form::text('name', $task_status->name ?? '', ['class' => 'form-control']) }}<br>
</div>
