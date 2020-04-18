@auth
    @include('comments::form')
@endauth

@php
    $count = $model->commentsWithChildrenAndCommenter()->count();
    $comments = $model->commentsWithChildrenAndCommenter()->parentless()->get();
@endphp
<ul class="ui small comments">
    @foreach($comments as $comment)
        @include('comments::components.comment.comment')
    @endforeach
</ul>
