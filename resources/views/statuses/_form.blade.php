<x-errors/>

<div class="field">
    {{ Form::label('name', __('Name')) }}
    {{ Form::text('name', $status->name ?? '', ['placeholder' => 'Name']) }}
</div>
