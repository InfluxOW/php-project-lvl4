@auth
    @include('comments::form')
@else
    @include('comments::login-message')
@endauth

@php
    $count = $model->commentsWithChildrenAndCommenter()->count();
    $comments = $model->commentsWithChildrenAndCommenter()->parentless()->get();
@endphp
@if($count < 1)
    <p class="lead">{{ __('There are no comments yet') }}.</p>
@endif
<ul class="list-unstyled">
    @foreach($comments as $comment)
        @include('comments::components.comment.comment')
    @endforeach
</ul>
