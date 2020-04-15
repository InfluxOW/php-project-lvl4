<x-errors/>

<div class="text-muted">
    {{ Form::label('name', __('Name'), ['class' => 'font-weight-normal']) }}<br>
    {{ Form::text('name', $status->name ?? '', ['class' => 'form-control']) }}<br>
</div>
