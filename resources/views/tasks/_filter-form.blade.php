
<div>
{{ Form::open(['url' => route('tasks.filtration') , 'method' => 'GET', 'class' => 'form-inline']) }}
    {{ Form::select('filter[creator_id][]', $creators, getDefaultFiltrationValues('creator_id'), ['class' => 'form-control mr-2 selectpicker', 'multiple', 'title' => __('Creator')]) }}
    {{ Form::select('filter[status.id][]', $statuses, getDefaultFiltrationValues('status.id'), ['class' => 'form-control mr-2 selectpicker', 'multiple', 'title' => __('Status')]) }}
    {{ Form::select('filter[assignees.id][]', $assignees, getDefaultFiltrationValues('assignees.id'), ['class' => 'form-control mr-2 selectpicker', 'multiple', 'title' => __('Assignee')])  }}
    {{ Form::select('filter[labels.id][]', $labels, getDefaultFiltrationValues('labels.id'), ['class' => 'form-control mr-2 selectpicker', 'multiple', 'title' => __('Label')])  }}
    {{ Form::submit(__('Apply'), ['class' => 'btn btn-outline-primary mr-2']) }}
{{ Form::close() }}
</div>

