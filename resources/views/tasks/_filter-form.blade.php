
<div>
{{ Form::open(['url' => route('tasks.filtration.index') , 'method' => 'GET', 'class' => 'ui form custom-top']) }}
    <div class="fields">
        <div class="field">{{ Form::select('filter[creator_id][]', $creators, getDefaultFiltrationValues('creator_id'), ['class' => 'ui dropdown', 'multiple' => '', 'placeholder' => 'Creator']) }}</div>
        <div class="field">{{ Form::select('filter[status.id][]', $statuses, getDefaultFiltrationValues('status.id'), ['class' => 'ui dropdown', 'multiple' => '', 'placeholder' => 'Status']) }}</div>
        <div class="field">{{ Form::select('filter[assignees.id][]', $assignees, getDefaultFiltrationValues('assignees.id'), ['class' => 'ui dropdown', 'multiple' => '', 'placeholder' => 'Assignee'])  }}</div>
        <div class="field">{{ Form::select('filter[labels.id][]', $labels, getDefaultFiltrationValues('labels.id'), ['class' => 'ui dropdown', 'multiple' => '', 'placeholder' => 'Label'])  }}</div>
        {{ Form::submit(__('Apply'), ['class' => 'ui primary button fluid']) }}
    </div>
{{ Form::close() }}
</div>
