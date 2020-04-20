<div class="text-muted">
    Created {{ $model->created_at->diffForHumans() }}
    by <a href="route('users.show', $model->creator)">{{ $model->creator->name }}</a> </a>
</div>
