<div class="text-muted">
    {{ __('Created') }} {{ $model->created_at->diffForHumans() }}
    {{ _('by') }} <a href="route('users.show', $model->creator)">{{ $model->creator->name }}</a> </a>
</div>
